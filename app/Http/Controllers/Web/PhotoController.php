<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class PhotoController extends Controller
{
    private const WATERMARK_ASSET_PATH = 'assets/watermark.png';

    private const WATERMARK_WIDTH = 300;

    private const WATERMARK_TILE_GAP = 280;

    // ════════════════════════════════
    // SHOW FORM UPLOAD
    // ════════════════════════════════
    public function showUpload()
    {
        $events = Event::where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->get();

        return view('photographer.upload', compact('events'));
    }

    // ════════════════════════════════
    // UPLOAD FOTO (Fotografer)
    // ════════════════════════════════
    public function upload(Request $request)
    {
        $request->validate([
            'photos' => 'required|array|min:1',
            'photos.*' => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'event_id' => 'nullable|exists:events,id',
            'price' => 'required|numeric|min:5000',
            'category' => 'nullable|string|max:50',
        ]);

        $photographer = Auth::user();
        $results = [];

        foreach ($request->file('photos') as $file) {
            // 1. Simpan foto ASLI ke R2
            $filename = uniqid().'_'.time().'.'.$file->getClientOriginalExtension();
            $r2Path = 'photos/original/'.$filename;
            Storage::disk('s3')->put($r2Path, file_get_contents($file), 'private');
            $r2Url = env('AWS_URL').'/'.$r2Path;

            // 2. Generate WATERMARK
            try {
                $watermarkPath = $this->generateWatermark($file, $filename);
            } catch (\RuntimeException $e) {
                Log::error('Watermark generation failed filename='.$filename.' msg='.$e->getMessage());

                return back()->withInput()
                    ->with('error', 'Gagal membuat watermark foto. Pastikan file watermark tersedia dan valid.');
            }

            // 3. Simpan ke DB
            $photo = Photo::create([
                'photographer_id' => $photographer->id,
                'event_id' => $request->event_id ?? null,
                'filename' => $filename,
                'r2_path' => $r2Path,
                'r2_url' => $r2Url,
                'watermark_path' => $watermarkPath,
                'price' => $request->price,
                'embed_status' => 'pending',
                'category' => $request->category ?? null,
                'is_active' => true,
            ]);

            // 4. Kirim ke FastAPI untuk embedding
            $this->embedPhoto($photo);

            $results[] = [
                'photo_id' => $photo->id,
                'filename' => $filename,
                'embed_status' => $photo->fresh()->embed_status,
            ];
        }

        return redirect()->route('photographer.portfolio')
            ->with('success', count($results).' foto berhasil diupload.');
    }

    // ════════════════════════════════
    // PORTFOLIO — LIST FOTO MILIK FOTOGRAFER
    // ════════════════════════════════
    public function index()
    {
        $photos = Photo::where('photographer_id', Auth::id())
            ->with('event:id,name')
            ->latest()
            ->paginate(20);

        return view('photographer.portfolio', compact('photos'));
    }

    // ════════════════════════════════
    // UPDATE HARGA FOTO
    // ════════════════════════════════
    public function updatePrice(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:5000',
        ]);

        $photo = Photo::where('id', $id)
            ->where('photographer_id', Auth::id())
            ->firstOrFail();

        $photo->update(['price' => $request->price]);

        return redirect()->route('photographer.portfolio')
            ->with('success', 'Harga foto berhasil diperbarui.');
    }

    // ════════════════════════════════
    // PRIVATE: Generate Watermark
    // ════════════════════════════════
    private function generateWatermark($file, string $filename): string
    {
        $manager = new ImageManager(
            new Driver
        );

        $image = $manager->decode(file_get_contents($file->getRealPath()));

        $watermarkFile = public_path(self::WATERMARK_ASSET_PATH);

        if (! file_exists($watermarkFile) || ! is_readable($watermarkFile)) {
            throw new \RuntimeException('Watermark asset not found or unreadable.');
        }

        try {
            $watermark = $manager->decode(file_get_contents($watermarkFile))
                ->scale(width: self::WATERMARK_WIDTH);
        } catch (\Throwable $e) {
            throw new \RuntimeException('Watermark asset cannot be decoded.', previous: $e);
        }

        $imgWidth = $image->width();
        $imgHeight = $image->height();

        for ($x = 0; $x < $imgWidth; $x += self::WATERMARK_TILE_GAP) {
            for ($y = 0; $y < $imgHeight; $y += self::WATERMARK_TILE_GAP) {
                $image->insert($watermark, $x, $y);
            }
        }

        $watermarkFilename = pathinfo($filename, PATHINFO_FILENAME).'.jpg';
        $watermarkPath = 'photos/watermark/'.$watermarkFilename;
        Storage::disk('s3')->put(
            $watermarkPath,
            (string) $image->encode(new JpegEncoder(quality: 80)),
            'public'
        );

        return $watermarkPath;
    }

    // ════════════════════════════════
    // PRIVATE: Embed ke FastAPI
    // ════════════════════════════════
    private function embedPhoto(Photo $photo): void
    {
        try {
            $response = Http::withHeaders([
                'X-API-Key' => env('AI_API_KEY'),
            ])->timeout(30)->post(env('AI_BASE_URL').'/embed-photo', [
                'photo_id' => $photo->id,
                'photo_url' => env('AWS_URL').'/'.$photo->watermark_path,
            ]);

            if ($response->successful()) {
                $photo->update(['embed_status' => 'embedded']);
            } else {
                Log::error('Embed failed photo_id='.$photo->id.' status='.$response->status());
                $photo->update(['embed_status' => 'failed']);
            }
        } catch (\Exception $e) {
            Log::error('Embed exception photo_id='.$photo->id.' msg='.$e->getMessage());
            $photo->update(['embed_status' => 'failed']);
        }
    }
}
