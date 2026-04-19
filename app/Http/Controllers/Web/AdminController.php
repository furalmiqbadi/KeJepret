<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // ══════════════════════════════════════════
    // DASHBOARD ADMIN
    // ══════════════════════════════════════════
    public function dashboard()
    {
        $totalUsers         = DB::table('users')->count();
        $totalPhotographers = DB::table('users')->where('role', 'photographer')->count();
        $totalPhotos        = DB::table('photos')->where('is_active', true)->count();
        $totalOrders        = DB::table('orders')->where('status', 'paid')->count();
        $pendingWithdrawals = DB::table('withdrawals')->where('status', 'pending')->count();
        $pendingVerif       = DB::table('photographer_profiles')->where('verification_status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalPhotographers',
            'totalPhotos',
            'totalOrders',
            'pendingWithdrawals',
            'pendingVerif'
        ));
    }

    // ══════════════════════════════════════════
    // PENDING PHOTOGRAPHERS — Daftar fotografer pending verifikasi
    // ══════════════════════════════════════════
    public function pendingPhotographers()
    {
        // Tabel: photographer_profiles JOIN users
        // Kolom: verification_status (enum: pending|verified|rejected)
        // Kolom users: id, name, email
        // Kolom photographer_profiles: created_at
        $list = DB::table('photographer_profiles')
            ->join('users', 'photographer_profiles.user_id', '=', 'users.id')
            ->where('photographer_profiles.verification_status', 'pending')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'photographer_profiles.created_at'
            )
            ->get();

        return view('admin.photographers.pending', compact('list'));
    }

    // ══════════════════════════════════════════
    // VERIFY PHOTOGRAPHER
    // ══════════════════════════════════════════
    public function verifyPhotographer($id)
    {
        // Tabel: photographer_profiles
        // Kolom: verification_status, verified_at, updated_at
        DB::table('photographer_profiles')
            ->where('user_id', $id)
            ->update([
                'verification_status' => 'verified',
                'verified_at'         => now(),
                'updated_at'          => now(),
            ]);

        return redirect()->route('admin.photographers.pending')
            ->with('success', 'Fotografer berhasil diverifikasi.');
    }

    // ══════════════════════════════════════════
    // REJECT PHOTOGRAPHER
    // ══════════════════════════════════════════
    public function rejectPhotographer($id)
    {
        // Tabel: photographer_profiles
        // Kolom: verification_status (enum: pending|verified|rejected), updated_at
        DB::table('photographer_profiles')
            ->where('user_id', $id)
            ->update([
                'verification_status' => 'rejected',
                'updated_at'          => now(),
            ]);

        return redirect()->route('admin.photographers.pending')
            ->with('success', 'Fotografer berhasil ditolak.');
    }

    // ══════════════════════════════════════════
    // LIST EVENTS
    // ══════════════════════════════════════════
    public function listEvents()
    {
        // Tabel: events
        // Kolom: id, name, slug, description, location, event_date, cover_image, is_active, created_at
        $events = DB::table('events')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.events.index', compact('events'));
    }

    // ══════════════════════════════════════════
    // SHOW FORM CREATE EVENT
    // ══════════════════════════════════════════
    public function showCreateEvent()
    {
        return view('admin.events.create');
    }

    // ══════════════════════════════════════════
    // CREATE EVENT
    // ══════════════════════════════════════════
    public function createEvent(Request $request)
    {
        $request->validate([
            // Kolom events: name varchar(150)
            'name'        => 'required|string|max:150',
            // Kolom events: event_date (date)
            'event_date'  => 'required|date',
            // Kolom events: location varchar(200)
            'location'    => 'required|string|max:200',
            // Kolom events: description (text, nullable)
            'description' => 'nullable|string',
            // Kolom events: cover_image varchar(255, nullable)
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Upload cover image ke R2 jika ada
        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $file           = $request->file('cover_image');
            $filename       = 'event_cover_' . time() . '.' . $file->getClientOriginalExtension();
            $coverImagePath = 'events/covers/' . $filename;
            Storage::disk('s3')->put($coverImagePath, file_get_contents($file), 'public');
        }

        // Insert ke tabel events
        // Kolom: name, slug, event_date, location, description, cover_image, created_by, is_active
        $id = DB::table('events')->insertGetId([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name . '-' . time()),
            'event_date'  => $request->event_date,
            'location'    => $request->location,
            'description' => $request->description,
            'cover_image' => $coverImagePath,
            'created_by'  => Auth::id(),
            'is_active'   => true,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil dibuat.');
    }

    // ══════════════════════════════════════════
    // SHOW FORM EDIT EVENT
    // ══════════════════════════════════════════
    public function showEditEvent($id)
    {
        $event = DB::table('events')->where('id', $id)->firstOrFail();

        return view('admin.events.edit', compact('event'));
    }

    // ══════════════════════════════════════════
    // UPDATE EVENT
    // ══════════════════════════════════════════
    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'name'        => 'sometimes|string|max:150',
            'event_date'  => 'sometimes|date',
            'location'    => 'sometimes|string|max:200',
            'description' => 'nullable|string',
            'is_active'   => 'sometimes|boolean',
        ]);

        // Tabel: events
        // Kolom yang bisa diupdate: name, event_date, location, description, is_active
        DB::table('events')
            ->where('id', $id)
            ->update(array_merge(
                $request->only(['name', 'event_date', 'location', 'description', 'is_active']),
                ['updated_at' => now()]
            ));

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil diupdate.');
    }

    // ══════════════════════════════════════════
    // PENDING WITHDRAWALS
    // ══════════════════════════════════════════
    public function pendingWithdrawals()
    {
        // Tabel: withdrawals JOIN users
        // Kolom withdrawals: *, status (pending|approved|rejected|transferred)
        // Kolom users: name as photographer_name
        $list = DB::table('withdrawals')
            ->join('users', 'withdrawals.photographer_id', '=', 'users.id')
            ->where('withdrawals.status', 'pending')
            ->select(
                'withdrawals.*',
                'users.name as photographer_name'
            )
            ->orderByDesc('withdrawals.created_at')
            ->get();

        return view('admin.withdrawals.pending', compact('list'));
    }

    // ══════════════════════════════════════════
    // APPROVE WITHDRAWAL
    // ══════════════════════════════════════════
    public function approveWithdrawal($id)
    {
        // Tabel: withdrawals
        // Kolom: status, approved_by (FK users), approved_at, updated_at
        DB::table('withdrawals')
            ->where('id', $id)
            ->update([
                'status'      => 'approved',
                'approved_by' => Auth::id(),
                'approved_at' => now(),
                'updated_at'  => now(),
            ]);

        return redirect()->route('admin.withdrawals.pending')
            ->with('success', 'Withdrawal berhasil diapprove.');
    }

    // ══════════════════════════════════════════
    // REJECT WITHDRAWAL
    // ══════════════════════════════════════════
    public function rejectWithdrawal(Request $request, $id)
    {
        $request->validate([
            // Kolom: rejection_reason (text)
            'rejection_reason' => 'required|string',
        ]);

        // Tabel: withdrawals
        // Kolom: status, rejection_reason, approved_by, updated_at
        DB::table('withdrawals')
            ->where('id', $id)
            ->update([
                'status'           => 'rejected',
                'rejection_reason' => $request->rejection_reason,
                'approved_by'      => Auth::id(),
                'updated_at'       => now(),
            ]);

        return redirect()->route('admin.withdrawals.pending')
            ->with('success', 'Withdrawal berhasil ditolak.');
    }

    // ══════════════════════════════════════════
    // DEACTIVATE PHOTO
    // ══════════════════════════════════════════
    public function deactivatePhoto($id)
    {
        // Tabel: photos
        // Kolom: is_active (boolean), updated_at
        DB::table('photos')
            ->where('id', $id)
            ->update([
                'is_active'  => false,
                'updated_at' => now(),
            ]);

        return redirect()->back()
            ->with('success', 'Foto berhasil dinonaktifkan.');
    }
}
