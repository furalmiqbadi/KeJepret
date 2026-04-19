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
        // 6 event terbaru yang aktif untuk ditampilkan di home
        $events = Event::where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->limit(6)
            ->get();

        // Total foto & event untuk stats
        $totalPhotos = Photo::where('is_active', true)->count();
        $totalEvents = Event::where('is_active', true)->count();

        return view('home', compact('events', 'totalPhotos', 'totalEvents'));
    }

    // ═══════════════════════════════
    // EVENT — Daftar Semua Event
    // ═══════════════════════════════
    public function event(Request $request)
    {
        $query = Event::where('is_active', true);

        // Filter pencarian nama atau lokasi
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('location', 'like', '%' . $request->q . '%');
            });
        }

        // Filter kota
        if ($request->filled('city')) {
            $query->where('location', 'like', '%' . $request->city . '%');
        }

        // Filter tanggal
        if ($request->filled('date')) {
            $query->whereDate('event_date', $request->date);
        }

        $events = $query->orderBy('event_date', 'desc')->paginate(12);

        return view('event', compact('events'));
    }

    // ═══════════════════════════════
    // SEARCH — Halaman Pencarian Foto
    // ═══════════════════════════════
    public function search(Request $request)
    {
        // Ambil semua event aktif untuk dropdown/filter
        $events = Event::where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->get();

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
