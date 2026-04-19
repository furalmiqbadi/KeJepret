<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Photo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // ═══════════════════════════════
    // HOME — Halaman Utama
    // ═══════════════════════════════
    public function index()
    {
        $events = Event::where('is_active', true)
            ->withCount('photos')
            ->orderBy('event_date', 'desc')
            ->limit(6)
            ->get();

        $totalPhotos = Photo::where('is_active', true)->count();
        $totalEvents = Event::where('is_active', true)->count();

        return view('home', compact('events', 'totalPhotos', 'totalEvents'));
    }

    // ═══════════════════════════════
    // EVENT — Daftar Semua Event
    // ═══════════════════════════════
    public function event(Request $request)
    {
        $query = Event::where('is_active', true)->withCount('photos');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('location', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('city')) {
            $query->where('location', 'like', '%' . $request->city . '%');
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
    // SEARCH — Halaman Pencarian Foto
    // ═══════════════════════════════
    public function search(Request $request)
    {
        $query = Event::where('is_active', true)->withCount('photos');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('location', 'like', '%' . $request->q . '%');
            });
        }

        $events = $query->orderBy('event_date', 'desc')->get();

        return view('search', compact('events'));
    }

    // ═══════════════════════════════
    // PROFIL — Halaman Profil Publik
    // ═══════════════════════════════
    public function profil()
    {
        return view('profil');
    }
}
