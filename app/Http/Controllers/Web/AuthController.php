<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PhotographerBalance;
use App\Models\PhotographerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ═══════════════════════════════
    // SHOW FORM REGISTER
    // ═══════════════════════════════
    public function showRegister()
    {
        return view('auth.register');
    }

    // ═══════════════════════════════
    // REGISTER
    // ═══════════════════════════════
    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:100',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:8|confirmed',
            'role'                  => 'required|in:runner,photographer',
            'phone'                 => 'nullable|string|max:20',
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

        // Login otomatis setelah register
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    // ═══════════════════════════════
    // SHOW FORM LOGIN
    // ═══════════════════════════════
    public function showLogin()
    {
        return view('auth.login');
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
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput();
        }

        if (!$user->is_active) {
            return back()->withErrors([
                'email' => 'Akun kamu dinonaktifkan. Hubungi admin.',
            ])->withInput();
        }

        Auth::login($user);

        // Redirect berdasarkan role
        return match ($user->role) {
            'admin'        => redirect()->route('admin.dashboard'),
            'photographer' => redirect()->route('photographer.dashboard'),
            'runner'       => redirect()->route('runner.dashboard'),
            default        => redirect()->route('dashboard'),
        };
    }

    // ═══════════════════════════════
    // LOGOUT
    // ═══════════════════════════════
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // ═══════════════════════════════
    // DASHBOARD — redirect sesuai role
    // ═══════════════════════════════
    public function dashboard()
    {
        $user = Auth::user();

        return match ($user->role) {
            'admin'        => redirect()->route('admin.dashboard'),
            'photographer' => redirect()->route('photographer.dashboard'),
            'runner'       => redirect()->route('runner.dashboard'),
            default        => abort(403),
        };
    }
}
