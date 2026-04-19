<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PhotographerBalance;
use App\Models\PhotographerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // ═══════════════════════════════
    // REGISTER
    // ═══════════════════════════════
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:runner,photographer',
            'phone'    => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'role'     => $request->role,
            'phone'    => $request->phone,
        ]);

        // Jika fotografer → buat profil + saldo otomatis
        if ($user->isPhotographer()) {
            PhotographerProfile::create([
                'user_id'             => $user->id,
                'verification_status' => 'pending',
            ]);

            PhotographerBalance::create([
                'photographer_id' => $user->id,
                'balance'         => 0,
                'total_earned'    => 0,
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'data'    => [
                'user'  => $user,
                'token' => $token,
            ],
        ], 201);
    }

    // ═══════════════════════════════
    // LOGIN
    // ═══════════════════════════════
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Akun kamu dinonaktifkan. Hubungi admin.',
            ], 403);
        }

        // Hapus token lama, buat token baru
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Load profil fotografer jika ada
        $profile = $user->isPhotographer()
            ? $user->photographerProfile
            : null;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data'    => [
                'user'    => $user,
                'profile' => $profile,
                'token'   => $token,
            ],
        ]);
    }

    // ═══════════════════════════════
    // LOGOUT
    // ═══════════════════════════════
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }

    // ═══════════════════════════════
    // ME — Data user yang sedang login
    // ═══════════════════════════════
    public function me(Request $request)
    {
        $user = $request->user();

        $profile = $user->isPhotographer()
            ? $user->photographerProfile
            : null;

        $balance = $user->isPhotographer()
            ? $user->photographerBalance
            : null;

        return response()->json([
            'success' => true,
            'data'    => [
                'user'    => $user,
                'profile' => $profile,
                'balance' => $balance,
            ],
        ]);
    }
}