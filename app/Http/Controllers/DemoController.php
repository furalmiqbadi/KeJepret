<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DemoController extends Controller
{
    private $aiBaseUrl;
    private $apiKey;

    public function __construct()
    {
        $this->aiBaseUrl = rtrim(env('AI_BASE_URL'), '/');
        $this->apiKey    = env('AI_API_KEY');
    }

    // ─── HALAMAN 1: UPLOAD ────────────────────────────────
    public function uploadView()
    {
        $photos = DB::table('demo_photos')->orderByDesc('id')->get();
        return view('demo.upload', compact('photos'));
    }

    public function uploadProcess(Request $request)
    {
        $request->validate(['photo' => 'required|image|max:10240']);

        try {
            $file     = $request->file('photo');
            $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $r2Path   = 'demo-photos/' . $fileName;

            // 1. Upload ke R2 (tanpa 'public' — R2 tidak support ACL)
            Storage::disk('s3')->put($r2Path, file_get_contents($file));
            $r2Url = env('AWS_URL') . '/' . $r2Path;

            // 2. Simpan ke DB (status: uploaded)
            $photoId = DB::table('demo_photos')->insertGetId([
                'filename'   => $fileName,
                'r2_url'     => $r2Url,
                'status'     => 'uploaded',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 3. Kirim ke FastAPI /embed-photo (BUKAN /embed)
            $aiResponse = Http::timeout(60)
                ->withHeaders(['X-API-Key' => $this->apiKey])
                ->post($this->aiBaseUrl . '/embed-photo', [
                    'photo_id'  => $photoId,
                    'photo_url' => $r2Url,
                ]);

            if ($aiResponse->successful()) {
                // 4. Update DB: status embedded + simpan ai_photo_id
                DB::table('demo_photos')->where('id', $photoId)->update([
                    'ai_photo_id' => $aiResponse->json('photo_id') ?? $photoId,
                    'status'      => 'embedded',
                    'updated_at'  => now(),
                ]);
            } else {
                Log::warning('AI /embed-photo error: ' . $aiResponse->body());
            }

            return response()->json([
                'success' => true,
                'message' => 'Upload berhasil! Status: ' . ($aiResponse->successful() ? 'Embedded ✅' : 'Uploaded (AI pending) ⚠️'),
                'url'     => $r2Url,
            ]);

        } catch (\Exception $e) {
            Log::error('Upload error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // ─── HALAMAN 2: SEARCH ────────────────────────────────
    public function searchView()
    {
        return view('demo.search');
    }

    public function searchProcess(Request $request)
    {
        $request->validate(['selfie' => 'required|image|max:10240']);

        try {
            $file     = $request->file('selfie');
            $fileName = 'selfie_' . time() . '.jpg';
            $r2Path   = 'demo-selfies/' . $fileName;

            // 1. Upload selfie ke R2 (tanpa 'public' — R2 tidak support ACL)
            Storage::disk('s3')->put($r2Path, file_get_contents($file));
            $selfieUrl = env('AWS_URL') . '/' . $r2Path;

            // 2. Simpan runner ke DB
            $runnerId = DB::table('demo_runners')->insertGetId([
                'selfie_url' => $selfieUrl,
                'status'     => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 3. Enroll selfie ke FastAPI /enroll
            $enrollRes = Http::timeout(60)
                ->withHeaders(['X-API-Key' => $this->apiKey])
                ->post($this->aiBaseUrl . '/enroll', [
                    'runner_id'  => $runnerId,
                    'selfie_url' => $selfieUrl,
                ]);

            if (!$enrollRes->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal enroll: ' . $enrollRes->body()
                ], 500);
            }

            // 4. Update runner status
            DB::table('demo_runners')->where('id', $runnerId)->update([
                'ai_runner_id' => $enrollRes->json('runner_id') ?? $runnerId,
                'status'       => 'enrolled',
                'updated_at'   => now(),
            ]);

            // 5. Ambil semua ai_photo_id yang sudah embedded dari DB
            $allPhotoIds = DB::table('demo_photos')
                ->where('status', 'embedded')
                ->pluck('ai_photo_id')
                ->toArray();

            if (empty($allPhotoIds)) {
                return response()->json([
                    'success' => true,
                    'count'   => 0,
                    'photos'  => [],
                    'message' => 'Belum ada foto event yang diproses AI.',
                ]);
            }

            // 6. Search ke FastAPI /search dengan runner_id + photo_ids
            $searchRes = Http::timeout(60)
                ->withHeaders(['X-API-Key' => $this->apiKey])
                ->post($this->aiBaseUrl . '/search', [
                    'runner_id'  => $runnerId,
                    'photo_ids'  => $allPhotoIds,
                ]);

            if (!$searchRes->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal search: ' . $searchRes->body()
                ], 500);
            }

            // 7. Ambil foto dari DB berdasarkan photo_id hasil AI
            // Response AI pakai key "matched" bukan "matches"
            $matches  = $searchRes->json('matched') ?? [];
            $photoIds = collect($matches)->pluck('photo_id')->toArray();
            $scores   = collect($matches)->keyBy('photo_id');

            $photos = DB::table('demo_photos')
                ->whereIn('ai_photo_id', $photoIds)
                ->get()
                ->map(function ($p) use ($scores) {
                    // score dari AI sudah dalam format 0-100
                    $p->score = $scores[$p->ai_photo_id]->score ?? 0;
                    return $p;
                })
                ->sortByDesc('score')
                ->values();

            return response()->json([
                'success' => true,
                'count'   => $photos->count(),
                'photos'  => $photos,
            ]);

        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}