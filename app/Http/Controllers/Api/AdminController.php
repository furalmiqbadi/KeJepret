<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function pendingPhotographers()
    {
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

        return response()->json(['success' => true, 'data' => $list]);
    }

    public function verifyPhotographer($id)
    {
        DB::table('photographer_profiles')
            ->where('user_id', $id)
            ->update([
                'verification_status' => 'verified',
                'verified_at'         => now(),
                'updated_at'          => now()
            ]);

        return response()->json(['success' => true, 'message' => 'Fotografer berhasil diverifikasi']);
    }

    public function rejectPhotographer($id)
    {
        DB::table('photographer_profiles')
            ->where('user_id', $id)
            ->update([
                'verification_status' => 'rejected',
                'updated_at'          => now()
            ]);

        return response()->json(['success' => true, 'message' => 'Fotografer ditolak']);
    }

    public function listEvents()
    {
        $events = DB::table('events')
            ->orderByDesc('created_at')
            ->get();

        return response()->json(['success' => true, 'data' => $events]);
    }

    public function createEvent(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'event_date'  => 'required|date',
            'location'    => 'required|string',
            'description' => 'nullable|string',
        ]);

        $id = DB::table('events')->insertGetId([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name . '-' . time()),
            'event_date'  => $request->event_date,
            'location'    => $request->location,
            'description' => $request->description,
            'created_by'  => $request->user()->id,
            'is_active'   => true,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event berhasil dibuat',
            'data'    => ['id' => $id]
        ]);
    }

    public function updateEvent(Request $request, $id)
    {
        DB::table('events')
            ->where('id', $id)
            ->update(array_merge(
                $request->only(['name', 'event_date', 'location', 'description', 'is_active']),
                ['updated_at' => now()]
            ));

        return response()->json(['success' => true, 'message' => 'Event berhasil diupdate']);
    }

    public function pendingWithdrawals()
    {
        $list = DB::table('withdrawals')
            ->join('users', 'withdrawals.photographer_id', '=', 'users.id')
            ->where('withdrawals.status', 'pending')
            ->select(
                'withdrawals.*',
                'users.name as photographer_name'
            )
            ->orderByDesc('withdrawals.created_at')
            ->get();

        return response()->json(['success' => true, 'data' => $list]);
    }

    public function approveWithdrawal(Request $request, $id)
    {
        DB::table('withdrawals')
            ->where('id', $id)
            ->update([
                'status'      => 'approved',
                'approved_by' => $request->user()->id,
                'approved_at' => now(),
                'updated_at'  => now()
            ]);

        return response()->json(['success' => true, 'message' => 'Withdrawal diapprove']);
    }

    public function rejectWithdrawal(Request $request, $id)
    {
        $request->validate(['rejection_reason' => 'required|string']);

        DB::table('withdrawals')
            ->where('id', $id)
            ->update([
                'status'           => 'rejected',
                'rejection_reason' => $request->rejection_reason,
                'approved_by'      => $request->user()->id,
                'updated_at'       => now()
            ]);

        return response()->json(['success' => true, 'message' => 'Withdrawal ditolak']);
    }

    public function deactivatePhoto($id)
    {
        DB::table('photos')
            ->where('id', $id)
            ->update([
                'is_active'  => false,
                'updated_at' => now()
            ]);

        return response()->json(['success' => true, 'message' => 'Foto berhasil dinonaktifkan']);
    }
}