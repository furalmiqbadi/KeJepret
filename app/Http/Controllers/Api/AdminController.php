<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function pendingPhotographers()
    {
        $list = DB::table('photographer_profiles')
            ->join('users', 'photographer_profiles.user_id', '=', 'users.id')
            ->where('photographer_profiles.verification_status', 'pending')
            ->select('users.id', 'users.name', 'users.email', 'photographer_profiles.created_at')
            ->get();

        return response()->json(['success' => true, 'data' => $list]);
    }

    public function verifyPhotographer($id)
    {
        DB::table('photographer_profiles')
            ->where('user_id', $id)
            ->update(['verification_status' => 'verified', 'verified_at' => now(), 'updated_at' => now()]);

        return response()->json(['success' => true, 'message' => 'Fotografer berhasil diverifikasi']);
    }

    public function rejectPhotographer($id)
    {
        DB::table('photographer_profiles')
            ->where('user_id', $id)
            ->update(['verification_status' => 'rejected', 'updated_at' => now()]);

        return response()->json(['success' => true, 'message' => 'Fotografer ditolak']);
    }

    public function listEvents()
    {
        $events = DB::table('events')->orderByDesc('created_at')->get();
        return response()->json(['success' => true, 'data' => $events]);
    }

    public function createEvent(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'date'     => 'required|date',
            'location' => 'required|string'
        ]);

        $id = DB::table('events')->insertGetId([
            'name'       => $request->name,
            'date'       => $request->date,
            'location'   => $request->location,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Event berhasil dibuat', 'data' => ['id' => $id]]);
    }

    public function updateEvent(Request $request, $id)
    {
        DB::table('events')->where('id', $id)->update(array_merge(
            $request->only(['name', 'date', 'location']),
            ['updated_at' => now()]
        ));

        return response()->json(['success' => true, 'message' => 'Event berhasil diupdate']);
    }

    public function pendingWithdrawals()
    {
        $list = DB::table('withdrawals')
            ->join('users', 'withdrawals.photographer_id', '=', 'users.id')
            ->where('withdrawals.status', 'pending')
            ->select('withdrawals.*', 'users.name as photographer')
            ->get();

        return response()->json(['success' => true, 'data' => $list]);
    }

    public function approveWithdrawal($id)
    {
        DB::table('withdrawals')->where('id', $id)->update(['status' => 'approved', 'updated_at' => now()]);
        return response()->json(['success' => true, 'message' => 'Withdrawal diapprove']);
    }

    public function rejectWithdrawal($id)
    {
        DB::table('withdrawals')->where('id', $id)->update(['status' => 'rejected', 'updated_at' => now()]);
        return response()->json(['success' => true, 'message' => 'Withdrawal ditolak']);
    }

    public function deactivatePhoto($id)
    {
        DB::table('photos')->where('id', $id)->update(['is_active' => false, 'updated_at' => now()]);
        return response()->json(['success' => true, 'message' => 'Foto berhasil dinonaktifkan']);
    }
}