<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PhotographerBalance;
use App\Models\PhotographerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

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

        if ($user->is_banned) {
            return redirect()->route('banned')->with('banned_reason', $user->banned_reason);
        }

        Auth::login($user);

        return match ($user->role) {
            'admin'        => redirect()->route('filament.admin.pages.dashboard'),
            'photographer' => redirect()->route('photographer.portfolio'),
            'runner'       => redirect()->route('home'),
            default        => redirect()->route('home'),
        };
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone'    => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'runner',
            'phone'    => $request->phone,
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function showRegisterPhotographer()
    {
        return view('auth.register-photographer');
    }

    public function registerPhotographer(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:8|confirmed',
            'phone'     => 'nullable|string|max:20',
            'ktp_photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'photographer',
            'phone'    => $request->phone,
        ]);

        $ktpPath = null;
        if ($request->hasFile('ktp_photo')) {
            $file = $request->file('ktp_photo');
            $filename = 'ktp_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $ktpPath = 'photographers/ktp/' . $filename;
            Storage::disk('s3')->put($ktpPath, file_get_contents($file), 'private');
        }

        PhotographerProfile::create([
            'user_id'             => $user->id,
            'ktp_photo'           => $ktpPath,
            'verification_status' => 'pending',
        ]);

        PhotographerBalance::create([
            'photographer_id' => $user->id,
            'balance'         => 0,
            'total_earned'    => 0,
        ]);

        Auth::login($user);

        return redirect()->route('photographer.portfolio');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function dashboard()
    {
        $user = Auth::user();

        return match ($user->role) {
            'admin'        => redirect()->route('filament.admin.pages.dashboard'),
            'photographer' => redirect()->route('photographer.portfolio'),
            'runner'       => redirect()->route('home'),
            default        => redirect()->route('home'),
        };
    }
}
