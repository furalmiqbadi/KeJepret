<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    // ═══════════════════════════════
    // HOME — Halaman Utama
    // ═══════════════════════════════
    public function index()
    {
        // FIX 5: Guard photographer — redirect ke halaman mereka
        if (Auth::check() && Auth::user()->role === 'photographer') {
            $profile = Auth::user()->photographerProfile;
            if ($profile && $profile->verification_status === 'verified') {
                return redirect()->route('photographer.portfolio');
            }

            return redirect()->route('photographer.waiting');
        }

        $events = Event::where('is_active', true)
            ->withCount('photos')
            ->orderBy('event_date', 'desc')
            ->limit(6)
            ->get();

        $totalPhotos = Photo::where('is_active', true)->count();
        $totalEvents = Event::where('is_active', true)->count();

        $randomPhotos = Photo::where('is_active', true)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('home', compact('events', 'totalPhotos', 'totalEvents', 'randomPhotos'));
    }

    // ═══════════════════════════════
    // EVENT — Daftar Semua Event
    // ═══════════════════════════════
    public function event(Request $request)
    {
        $query = Event::where('is_active', true)->withCount('photos');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'ilike', '%'.$request->q.'%')
                    ->orWhere('location', 'ilike', '%'.$request->q.'%');
            });
        }

        if ($request->filled('city')) {
            $query->where('location', 'ilike', '%'.$request->city.'%');
        }

        if ($request->filled('date')) {
            $query->whereDate('event_date', $request->date);
        }

        $events = $query->orderBy('event_date', 'desc')->paginate(12);

        return view('event', compact('events'));
    }

    // ═══════════════════════════════
    // EVENT DETAIL
    // ═══════════════════════════════
    public function eventDetail($id)
    {
        $event = Event::where('is_active', true)
            ->withCount('photos')
            ->findOrFail($id);

        return view('event-detail', compact('event'));
    }

    // ═══════════════════════════════
    // AJUKAN EVENT
    // ═══════════════════════════════
    public function proposeEventForm()
    {
        return view('event-propose');
    }

    public function storeProposedEvent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'event_date' => 'required|date',
            'location' => 'required|string|max:200',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $counter = 1;
        while (Event::where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('events/covers', 's3');
        }

        Event::create([
            'created_by' => Auth::id(),
            'name' => $request->name,
            'slug' => $slug,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'description' => $request->description,
            'cover_image' => $coverImagePath,
            'is_active' => false,
        ]);

        return redirect()->route('event.propose')->with('success', 'Pengajuan event berhasil dikirim dan sedang menunggu persetujuan admin.');
    }

    // ═══════════════════════════════
    // SEARCH — Halaman Pencarian Foto
    // ═══════════════════════════════
    public function search(Request $request)
    {
        $query = Event::where('is_active', true)->withCount('photos');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'ilike', '%'.$request->q.'%')
                    ->orWhere('location', 'ilike', '%'.$request->q.'%');
            });
        }

        if ($request->filled('event_id')) {
            $query->where('id', $request->event_id);
        }

        $events = $query->orderBy('event_date', 'desc')->get();

        $allEvents = Event::where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->get(['id', 'name', 'location', 'event_date']);

        return view('search', compact('events', 'allEvents'));
    }

    // ═══════════════════════════════
    // PROFIL — Halaman Profil Publik
    // ═══════════════════════════════
    public function profil()
    {
        // FIX 5: Guard photographer — redirect ke profil mereka
        if (Auth::check() && Auth::user()->role === 'photographer') {
            return redirect()->route('photographer.profil');
        }

        // FIX 6: Ambil 3 order terakhir untuk riwayat pembelian
        $recentOrders = DB::table('orders')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('profil', compact('recentOrders'));
    }
}
