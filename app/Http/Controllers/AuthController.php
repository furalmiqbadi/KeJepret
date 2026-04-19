<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login (Simulasi).
     */
    public function login(Request $request)
    {
        // Tanpa validasi email/password sesuai permintaan user.
        // Simulasi: Mengambil user pertama atau buat dummy jika kosong.
        $user = User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Pengguna Demo',
                'email' => 'demo@kejepret.com',
                'password' => bcrypt('password'),
            ]);
        }

        Auth::login($user);

        return redirect()->intended('/home');
    }

    /**
     * Tampilkan halaman register.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses register (Simulasi).
     */
    public function register(Request $request)
    {
        // Langsung arahkan ke login atau otomatis login setelah "daftar".
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Pengguna Baru Demo',
                'email' => 'new@kejepret.com',
                'password' => bcrypt('password'),
            ]);
        }
        
        Auth::login($user);

        return redirect('/home');
    }

    /**
     * Proses logout.
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
