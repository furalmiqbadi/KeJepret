<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Photo;
use App\Models\SearchSession;
use App\Models\SearchResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    private function buildResultPhotos(SearchSession $session)
    {
        $userId = Auth::id();

        $results = SearchResult::where('search_session_id', $session->id)->get();
        $matchedIds = $results->pluck('photo_id')->toArray();
        $scoreMap = $results->keyBy('photo_id');

        $cartPhotoIds = DB::table('cart_items')
            ->where('user_id', $userId)
            ->whereIn('photo_id', $matchedIds)
            ->pluck('photo_id')
            ->map(fn ($id) => (int) $id)
            ->toArray();

        $cartCount = DB::table('cart_items')
            ->where('user_id', $userId)
            ->count();

        $photos = Photo::whereIn('id', $matchedIds)
            ->where('is_active', true)
            ->with(['photographer:id,name', 'event:id,name'])
            ->get()
            ->map(function ($photo) use ($scoreMap, $cartPhotoIds) {
                return [
                    'photo_id'         => $photo->id,
                    'watermark_url'    => env('AWS_URL') . '/' . $photo->watermark_path,
                    'price'            => $photo->price,
                    'category'         => $photo->category,
                    'photographer'     => $photo->photographer->name ?? '-',
                    'event_name'       => $photo->event->name ?? '-',
                    'similarity_score' => $scoreMap[$photo->id]->similarity_score ?? 0,
                    'event_id'         => $photo->event_id,
                    'in_cart'          => in_array((int) $photo->id, $cartPhotoIds, true),
                ];
            })
            ->sortByDesc('similarity_score')
            ->values();

        return compact('photos', 'cartCount');
    }

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
    // Mendukung 2 input: file upload atau base64 dari kamera
    // ══════════════════════════════════════════
    public function search(Request $request)
    {
        // Validasi: salah satu dari file atau base64 wajib ada
        $request->validate([
            'selfie'        => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'selfie_base64' => 'nullable|string',
            'event_id'      => 'nullable|exists:events,id',
        ]);

        if (!$request->hasFile('selfie') && !$request->filled('selfie_base64')) {
            return back()->with('error', 'Selfie wajib diisi. Gunakan kamera atau upload file.');
        }

        $user = Auth::user();

        // ── Proses selfie: file atau base64 ──
        $filename   = 'selfie_' . $user->id . '_' . time();
        $selfiePath = 'selfies/temp/' . $filename . '.jpg';

        if ($request->hasFile('selfie')) {
            // Input dari file upload
            $file       = $request->file('selfie');
            $filename  .= '.' . $file->getClientOriginalExtension();
            $selfiePath = 'selfies/temp/' . $filename;
            Storage::disk('s3')->put($selfiePath, file_get_contents($file), 'private');
        } else {
            // Input dari kamera (base64)
            $base64Data = $request->input('selfie_base64');

            // Strip header data:image/jpeg;base64,
            if (str_contains($base64Data, ',')) {
                $base64Data = explode(',', $base64Data)[1];
            }

            $imageData = base64_decode($base64Data);

            if (!$imageData) {
                return back()->with('error', 'Data kamera tidak valid. Coba lagi.');
            }

            Storage::disk('s3')->put($selfiePath, $imageData, 'private');
        }

        $selfieUrl = env('AWS_URL') . '/' . $selfiePath;

        // Buat SearchSession awal
        $session = SearchSession::create([
            'user_id'        => $user->id,
            'event_id'       => $request->event_id ?? null,
            'selfie_r2_path' => $selfiePath,
            'enroll_status'  => 'pending',
            'search_status'  => 'pending',
            'result_count'   => 0,
        ]);

        try {
            // Enroll otomatis ke AI (upsert, tidak disimpan permanen)
            Http::withHeaders(['X-API-Key' => env('AI_API_KEY')])
                ->timeout(30)
                ->post(env('AI_BASE_URL') . '/enroll', [
                    'runner_id'  => $user->id,
                    'selfie_url' => $selfieUrl,
                ]);

            $session->update(['enroll_status' => 'enrolled']);

            // Ambil semua photo_id aktif
            $photoIds = Photo::where('is_active', true)
                ->when($request->event_id, fn($q) => $q->where('event_id', $request->event_id))
                ->pluck('id')
                ->toArray();

            if (empty($photoIds)) {
                $session->update(['search_status' => 'completed', 'result_count' => 0]);
                return back()->with('info', 'Belum ada foto untuk event ini.');
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
                return back()->with('info', 'Tidak ada foto yang cocok dengan wajahmu.');
            }

            // Simpan hasil ke search_results
            foreach ($matched as $item) {
                SearchResult::create([
                    'search_session_id' => $session->id,
                    'photo_id'          => $item['photo_id'],
                    'similarity_score'  => $item['score'] ?? 0,
                ]);
            }

            $session->update([
                'search_status' => 'completed',
                'result_count'  => $matched->count(),
            ]);

            ['photos' => $photos, 'cartCount' => $cartCount] = $this->buildResultPhotos($session);

            return view('runner.search-results', compact('photos', 'session', 'cartCount'));

        } catch (\Exception $e) {
            $session->update(['search_status' => 'failed']);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ══════════════════════════════════════════
    // SHOW FORM ENROLL — redirect ke search
    // ══════════════════════════════════════════
    public function showEnroll()
    {
        return redirect()->route('runner.search');
    }

    public function results($id)
    {
        $session = SearchSession::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('search_status', 'completed')
            ->firstOrFail();

        ['photos' => $photos, 'cartCount' => $cartCount] = $this->buildResultPhotos($session);

        return view('runner.search-results', compact('photos', 'session', 'cartCount'));
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
