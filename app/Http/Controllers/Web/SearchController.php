<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    // ══════════════════════════════════════════
    // SHOW FORM SEARCH
    // ══════════════════════════════════════════
    public function showSearch()
    {
        return view('search.index');
    }

    // ══════════════════════════════════════════
    // SEARCH BY SELFIE (Runner)
    // ══════════════════════════════════════════
    public function search(Request $request)
    {
        $request->validate([
            'selfie'   => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'event_id' => 'nullable|exists:events,id',
        ]);

        $user = Auth::user();

        // Upload selfie ke R2
        $file       = $request->file('selfie');
        $filename   = 'selfie_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $selfiePath = 'selfies/temp/' . $filename;
        Storage::disk('s3')->put($selfiePath, file_get_contents($file), 'private');
        $selfieUrl  = env('AWS_URL') . '/' . $selfiePath;

        try {
            // Enroll otomatis (upsert wajah)
            Http::withHeaders(['X-API-Key' => env('AI_API_KEY')])
                ->timeout(30)
                ->post(env('AI_BASE_URL') . '/enroll', [
                    'runner_id'  => $user->id,
                    'selfie_url' => $selfieUrl,
                ]);

            // Ambil semua photo_id yang aktif dari tabel photos
            // Kolom: is_active (boolean), event_id (nullable FK ke events)
            $photoIds = Photo::where('is_active', true)
                ->when($request->event_id, fn($q) => $q->where('event_id', $request->event_id))
                ->pluck('id')
                ->toArray();

            if (empty($photoIds)) {
                return back()->with('info', '0 foto ditemukan.');
            }

            // Kirim ke FastAPI /search
            $response = Http::withHeaders(['X-API-Key' => env('AI_API_KEY')])
                ->timeout(60)
                ->post(env('AI_BASE_URL') . '/search', [
                    'runner_id' => $user->id,
                    'photo_ids' => $photoIds,
                ]);

            if (!$response->successful()) {
                return back()->with('error', 'Pencarian gagal. Coba lagi.');
            }

            $aiResult   = $response->json();
            $matched    = collect($aiResult['matched'] ?? []);

            if ($matched->isEmpty()) {
                return back()->with('info', '0 foto ditemukan.');
            }

            $matchedIds = $matched->pluck('photo_id')->toArray();
            $scoreMap   = $matched->keyBy('photo_id');

            // Ambil foto dari DB berdasarkan matched IDs
            // Kolom photos: id, watermark_path, price, category, photographer_id, event_id, is_active
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

            return view('search.results', compact('photos'));

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ══════════════════════════════════════════
    // SHOW FORM ENROLL
    // ══════════════════════════════════════════
    public function showEnroll()
    {
        return view('search.enroll');
    }

    // ══════════════════════════════════════════
    // ENROLL WAJAH (Runner)
    // ══════════════════════════════════════════
    public function enroll(Request $request)
    {
        $request->validate([
            'selfie' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $user = Auth::user();

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
                return back()->with('error', 'Enroll wajah gagal. Coba lagi.');
            }

            return back()->with('success', 'Wajah berhasil didaftarkan!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ══════════════════════════════════════════
    // HISTORY PENCARIAN (Runner)
    // ══════════════════════════════════════════
    public function history()
    {
        // Sama seperti API: fitur history belum tersedia
        return view('search.history');
    }
}
