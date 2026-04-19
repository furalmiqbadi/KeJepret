<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    // SEARCH BY SELFIE (Runner)
    public function search(Request $request)
    {
        $request->validate([
            'selfie'   => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $user = $request->user();

        $file       = $request->file('selfie');
        $filename   = 'selfie_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $selfiePath = 'selfies/temp/' . $filename;
        Storage::disk('s3')->put($selfiePath, file_get_contents($file), 'private');
        $selfieUrl  = env('AWS_URL') . '/' . $selfiePath;

        try {
            // Enroll otomatis (upsert)
            Http::withHeaders(['X-API-Key' => env('AI_API_KEY')])
                ->timeout(30)
                ->post(env('AI_BASE_URL') . '/enroll', [
                    'runner_id'  => $user->id,
                    'selfie_url' => $selfieUrl,
                ]);

            // Ambil semua photo_id dari DB
            $photoIds = Photo::where('is_active', true)
                ->when($request->event_id, fn($q) => $q->where('event_id', $request->event_id))
                ->pluck('id')
                ->toArray();

            if (empty($photoIds)) {
                return response()->json(['success' => true, 'message' => '0 foto ditemukan', 'data' => []]);
            }

            // Kirim ke FastAPI /search
            $response = Http::withHeaders(['X-API-Key' => env('AI_API_KEY')])
                ->timeout(60)
                ->post(env('AI_BASE_URL') . '/search', [
                    'runner_id' => $user->id,
                    'photo_ids' => $photoIds,
                ]);

            if (!$response->successful()) {
                return response()->json(['success' => false, 'message' => 'Pencarian gagal.', 'debug' => $response->json()], 500);
            }

            $aiResult = $response->json();
            $matched  = collect($aiResult['matched'] ?? []);

            if ($matched->isEmpty()) {
                return response()->json(['success' => true, 'message' => '0 foto ditemukan', 'data' => []]);
            }

            $matchedIds = $matched->pluck('photo_id')->toArray();
            $scoreMap   = $matched->keyBy('photo_id');

            $photos = Photo::whereIn('id', $matchedIds)
                ->where('is_active', true)
                ->with(['photographer:id,name'])
                ->get()
                ->map(function ($photo) use ($scoreMap) {
                    return [
                        'photo_id'         => $photo->id,
                        'watermark_url'    => env('AWS_URL') . '/' . $photo->watermark_path,
                        'price'            => $photo->price,
                        'category'         => $photo->category,
                        'photographer'     => $photo->photographer->name ?? '-',
                        'similarity_score' => $scoreMap[$photo->id]['score'] ?? 0,
                        'event_id'         => $photo->event_id,
                    ];
                })
                ->sortByDesc('similarity_score')
                ->values();

            return response()->json(['success' => true, 'message' => count($matchedIds) . ' foto ditemukan', 'data' => $photos]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // ENROLL WAJAH (Runner)
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
                'runner_id'  => $user->id,
                'selfie_url' => $selfieUrl,
            ]);

            if (!$response->successful()) {
                return response()->json(['success' => false, 'message' => 'Enroll gagal.', 'debug' => $response->json()], 500);
            }

            return response()->json(['success' => true, 'message' => 'Wajah berhasil didaftarkan.', 'data' => $response->json()]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // SEARCH HISTORY (Runner)
    public function history(Request $request)
    {
        return response()->json(['success' => true, 'message' => 'Fitur history belum tersedia.', 'data' => []]);
    }
}