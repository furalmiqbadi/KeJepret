<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\PhotoEmbedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    // ═══════════════════════════════
    // UPLOAD FOTO (Fotografer)
    // ═══════════════════════════════
    public function upload(Request $request)
    {
        $request->validate([
            'photos'         => 'required|array|min:1',
            'photos.*'       => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'event_id'       => 'nullable|exists:events,id',
            'price'          => 'required|numeric|min:5000',
            'category'       => 'nullable|string|max:50',
        ]);

        $photographer = $request->user();
        $results      = [];

        foreach ($request->file('photos') as $file) {
            // 1. Simpan foto ASLI ke R2
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $r2Path   = 'photos/original/' . $filename;
            Storage::disk('s3')->put($r2Path, file_get_contents($file), 'private');
            $r2Url    = env('AWS_URL') . '/' . $r2Path;

            // 2. Generate WATERMARK
            $watermarkPath = $this->generateWatermark($file, $filename);

            // 3. Simpan ke DB
            $photo = Photo::create([
                'photographer_id' => $photographer->id,
                'event_id'        => $request->event_id,
                'filename'        => $filename,
                'r2_path'         => $r2Path,
                'r2_url'          => $r2Url,
                'watermark_path'  => $watermarkPath,
                'price'           => $request->price,
                'embed_status'    => 'pending',
                'category'        => $request->category,
            ]);

            // 4. Kirim ke FastAPI
            $this->embedPhoto($photo);

            $results[] = [
                'photo_id'     => $photo->id,
                'filename'     => $filename,
                'embed_status' => $photo->fresh()->embed_status,
            ];
        }

        return response()->json([
            'success' => true,
            'message' => count($results) . ' foto berhasil diupload',
            'data'    => $results,
        ], 201);
    }

    // ═══════════════════════════════
    // LIST FOTO MILIK FOTOGRAFER
    // ═══════════════════════════════
    public function index(Request $request)
    {
        $photos = Photo::where('photographer_id', $request->user()->id)
            ->with('event')
            ->latest()
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data'    => $photos,
        ]);
    }

    // ═══════════════════════════════
    // UPDATE HARGA FOTO
    // ═══════════════════════════════
    public function updatePrice(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:5000',
        ]);

        $photo = Photo::where('id', $id)
            ->where('photographer_id', $request->user()->id)
            ->firstOrFail();

        $photo->update(['price' => $request->price]);

        return response()->json([
            'success' => true,
            'message' => 'Harga berhasil diupdate',
            'data'    => $photo,
        ]);
    }

    // ═══════════════════════════════
    // PRIVATE: Generate Watermark
    // ═══════════════════════════════
    private function generateWatermark($file, string $filename): string
    {
        $manager = new \Intervention\Image\ImageManager(
            new \Intervention\Image\Drivers\Gd\Driver()
        );

        $image = $manager->decode(file_get_contents($file->getRealPath()));

        $watermarkFile = public_path('assets/watermark.png');

        if (file_exists($watermarkFile)) {
            $watermark = $manager->decode(file_get_contents($watermarkFile))->scale(width: 300);
            $imgWidth  = $image->width();
            $imgHeight = $image->height();

            for ($x = 0; $x < $imgWidth; $x += 280) {
                for ($y = 0; $y < $imgHeight; $y += 280) {
                    $image->insert($watermark, $x, $y);
                }
            }
        }

        $watermarkPath = 'photos/watermark/' . $filename;
        Storage::disk('s3')->put(
            $watermarkPath,
            (string) $image->encode(new \Intervention\Image\Encoders\JpegEncoder(quality: 80)),
            'public'
        );

        return $watermarkPath;
    }

    // ═══════════════════════════════
    // PRIVATE: Embed ke FastAPI
    // ═══════════════════════════════
    private function embedPhoto(Photo $photo): void
    {
        try {
            $response = Http::withHeaders([
                'X-API-Key' => env('AI_API_KEY'),
            ])->timeout(30)->post(env('AI_BASE_URL') . '/embed-photo', [
                'photo_id'  => $photo->id,  // integer, bukan string
                'photo_url' => env('AWS_URL') . '/' . $photo->watermark_path,  // public URL
            ]);

            if ($response->successful()) {
                $photo->update(['embed_status' => 'embedded']);
            } else {
                \Log::error('Embed failed: ' . $response->status() . ' - ' . $response->body());
                $photo->update(['embed_status' => 'failed']);
            }
        } catch (\Exception $e) {
            \Log::error('Embed failed: ' . $e->getMessage());
            $photo->update(['embed_status' => 'failed']);
        }
    }
}
