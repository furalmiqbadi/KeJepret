<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Photo;
use App\Models\SearchSession;
use App\Models\SearchResult;
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
        $events = Event::where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->get();

        return view('runner.search', compact('events'));
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

        // Buat SearchSession awal dengan status pending
        $session = SearchSession::create([
            'user_id'        => $user->id,
            'event_id'       => $request->event_id ?? null,
            'selfie_r2_path' => $selfiePath,
            'enroll_status'  => 'pending',
            'search_status'  => 'pending',
            'result_count'   => 0,
        ]);

        $selfieUrl = env('AWS_URL') . '/' . $selfiePath;

        try {
            // Enroll otomatis (upsert wajah ke AI)
            Http::withHeaders(['X-API-Key' => env('AI_API_KEY')])
                ->timeout(30)
                ->post(env('AI_BASE_URL') . '/enroll', [
                    'runner_id'  => $user->id,
                    'selfie_url' => $selfieUrl,
                ]);

            $session->update(['enroll_status' => 'enrolled']);

            // Ambil semua photo_id yang aktif
            $photoIds = Photo::where('is_active', true)
                ->when($request->event_id, fn($q) => $q->where('event_id', $request->event_id))
                ->pluck('id')
                ->toArray();

            if (empty($photoIds)) {
                $session->update(['search_status' => 'completed', 'result_count' => 0]);
                return back()->with('info', '0 foto ditemukan untuk event ini.');
            }

            // Kirim ke FastAPI /search
            $response = Http::withHeaders(['X-API-Key' => env('AI_API_KEY')])
                ->timeout(60)
                ->post(env('AI_BASE_URL') . '/search', [
                    'runner_id' => $user->id,
                    'photo_ids' => $photoIds,
                ]);

            if (!$response->successful()) {
                $session->update(['search_status' => 'failed']);
                return back()->with('error', 'Pencarian gagal. Coba lagi.');
            }

            $aiResult = $response->json();
            $matched  = collect($aiResult['matched'] ?? []);

            if ($matched->isEmpty()) {
                $session->update(['search_status' => 'completed', 'result_count' => 0]);
                return back()->with('info', '0 foto ditemukan.');
            }

            // Simpan hasil ke search_results
            foreach ($matched as $item) {
                SearchResult::create([
                    'session_id'       => $session->id,
                    'photo_id'         => $item['photo_id'],
                    'similarity_score' => $item['score'] ?? 0,
                ]);
            }

            // Update session: completed
            $session->update([
                'search_status' => 'completed',
                'result_count'  => $matched->count(),
            ]);

            $matchedIds = $matched->pluck('photo_id')->toArray();
            $scoreMap   = $matched->keyBy('photo_id');

            // Ambil foto dari DB
            $photos = Photo::whereIn('id', $matchedIds)
                ->where('is_active', true)
                ->with(['photographer:id,name', 'event:id,name'])
                ->get()
                ->map(function ($photo) use ($scoreMap) {
                    return [
                        'photo_id'         => $photo->id,
                        'watermark_url'    => env('AWS_URL') . '/' . $photo->watermark_path,
                        'price'            => $photo->price,
                        'category'         => $photo->category,
                        'photographer'     => $photo->photographer->name ?? '-',
                        'event_name'       => $photo->event->name ?? '-',
                        'similarity_score' => $scoreMap[$photo->id]['score'] ?? 0,
                        'event_id'         => $photo->event_id,
                    ];
                })
                ->sortByDesc('similarity_score')
                ->values();

            return view('runner.search-results', compact('photos', 'session'));

        } catch (\Exception $e) {
            $session->update(['search_status' => 'failed']);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ══════════════════════════════════════════
    // SHOW FORM ENROLL
    // ══════════════════════════════════════════
    public function showEnroll()
    {
        return view('runner.enroll');
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

            return back()->with('success', 'Wajah berhasil didaftarkan! Kamu sekarang bisa mencari fotomu.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ══════════════════════════════════════════
    // HISTORY PENCARIAN (Runner)
    // ══════════════════════════════════════════
    public function history()
    {
        $sessions = SearchSession::where('user_id', Auth::id())
            ->with('event:id,name,location,event_date')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('runner.search-history', compact('sessions'));
    }
}
