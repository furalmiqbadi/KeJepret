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
        // Simulasi Login berdasarkan email untuk membedakan role tanpa menyentuh database
        $email = $request->input('email');
        
        // Cari user demo atau pelari (karena kolom role tidak boleh ditambah ke DB)
        $user = User::where('email', $email)->first() ?? User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Pengguna Demo',
                'email' => 'demo@kejepret.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Simpan role di Session saja agar aman dari error DB
        if ($email === 'fotografer@kejepret.com') {
            session(['user_role' => 'fotografer']);
        } else {
            session(['user_role' => 'pelari']);
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
     * Tampilkan halaman register fotografer.
     */
    public function showRegisterFotografer()
    {
        return view('auth.register_fotografer');
    }

    /**
     * Proses register fotografer (Simulasi).
     */
    public function registerFotografer(Request $request)
    {
        // Simulasi: Buat user dengan role fotografer
        $user = User::create([
            'name' => 'Fotografer Demo',
            'email' => 'fotografer@kejepret.com',
            'password' => bcrypt('password'),
            'role' => 'fotografer',
        ]);
        
        Auth::login($user);

        return redirect('/home');
    }

    /**
     * Proses logout.
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
