<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    // ═══════════════════════════════
    // SEARCH BY SELFIE (Runner)
    // ═══════════════════════════════
    public function search(Request $request)
    {
        $request->validate([
            'selfie'   => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $user = $request->user();

        // 1. Upload selfie ke R2
        $file       = $request->file('selfie');
        $filename   = 'selfie_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $selfiePath = 'selfies/temp/' . $filename;
        Storage::disk('s3')->put($selfiePath, file_get_contents($file), 'private');
        $selfieUrl  = env('AWS_URL') . '/' . $selfiePath;

        // 2. Kirim ke FastAPI
        try {
            $payload = [
                'selfie_url' => $selfieUrl,
                'runner_id'  => (string) $user->id,
            ];
            if ($request->event_id) {
                $payload['event_id'] = (string) $request->event_id;
            }

            $response = Http::withHeaders([
                'X-API-Key' => env('AI_API_KEY'),
            ])->timeout(30)->post(env('AI_BASE_URL') . '/search', $payload);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pencarian gagal, coba lagi.',
                ], 500);
            }

            $aiResult   = $response->json();
            $photoIds   = collect($aiResult['results'] ?? [])->pluck('photo_id')->toArray();
            $similarity = collect($aiResult['results'] ?? [])->keyBy('photo_id');

            // 3. Ambil foto dari DB
            $photos = Photo::whereIn('id', $photoIds)
                ->where('is_active', true)
                ->with(['photographer:id,name'])
                ->get()
                ->map(function ($photo) use ($similarity) {
                    return [
                        'photo_id'         => $photo->id,
                        'watermark_url'    => env('AWS_URL') . '/' . $photo->watermark_path,
                        'price'            => $photo->price,
                        'category'         => $photo->category,
                        'photographer'     => $photo->photographer->name ?? '-',
                        'similarity_score' => $similarity[$photo->id]['similarity'] ?? 0,
                        'event_id'         => $photo->event_id,
                    ];
                })
                ->sortByDesc('similarity_score')
                ->values();

            return response()->json([
                'success' => true,
                'message' => count($photoIds) . ' foto ditemukan',
                'data'    => $photos,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ═══════════════════════════════
    // ENROLL WAJAH (Runner)
    // ═══════════════════════════════
    public function enroll(Request $request)
    {
        $request->validate([
            'selfie' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $user = $request->user();

        $file       = $request->file('selfie');
        $filename   = 'enroll_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $selfiePath = 'selfies/enroll/' . $filename;
        Storage::disk('s3')->put($selfiePath, file_get_contents($file), 'private');
        $selfieUrl  = env('AWS_URL') . '/' . $selfiePath;

        try {
            $response = Http::withHeaders([
                'X-API-Key' => env('AI_API_KEY'),
            ])->timeout(30)->post(env('AI_BASE_URL') . '/enroll', [
                'runner_id'  => (string) $user->id,
                'selfie_url' => $selfieUrl,
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Enroll gagal.',
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Wajah berhasil didaftarkan.',
                'data'    => $response->json(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
