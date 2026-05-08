@php $hideNav = true; @endphp
@extends('layouts.app')

@section('title', 'Daftar Fotografer')

@section('content')
<div class="h-screen flex items-center justify-center px-4 overflow-hidden py-2">
    <div class="w-full max-w-[420px] -mt-2">
        {{-- Header Register --}}
        <div class="text-center mb-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto mx-auto mb-1 object-contain">
            <h2 class="text-lg font-black text-gray-900 tracking-tight">Daftar Fotografer</h2>
        </div>

        {{-- Register Card --}}
        <div class="bg-white rounded-[1.25rem] p-4 border border-gray-100 shadow-lg relative overflow-hidden">
            <form action="{{ route('register.fotografer') }}" method="POST" class="space-y-2 relative z-10">
                @csrf
                <div class="grid grid-cols-2 gap-2.5">
                    <div class="space-y-0.5">
                        <label class="text-[8px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nama</label>
                        <div class="relative group">
                            <div class="absolute left-2 top-1/2 -translate-y-1/2 flex items-center justify-center w-8 h-8 bg-gray-50 border border-gray-100 rounded-xl group-focus-within:bg-green-600 group-focus-within:text-white group-focus-within:border-green-600 transition-all duration-300 shadow-sm">
                                <span class="material-symbols-outlined text-[18px] font-light">person</span>
                            </div>
                            <input type="text" name="name" placeholder="John" required
                                class="w-full pl-11 pr-2 py-2 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-900 outline-none focus:bg-white focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all font-sans">
                        </div>
                    </div>
                    <div class="space-y-0.5">
                        <label class="text-[8px] font-bold text-gray-400 uppercase tracking-widest ml-1">Email</label>
                        <div class="relative group">
                            <div class="absolute left-2 top-1/2 -translate-y-1/2 flex items-center justify-center w-8 h-8 bg-gray-50 border border-gray-100 rounded-xl group-focus-within:bg-green-600 group-focus-within:text-white group-focus-within:border-green-600 transition-all duration-300 shadow-sm">
                                <span class="material-symbols-outlined text-[18px] font-light">mail</span>
                            </div>
                            <input type="email" name="email" placeholder="nama@email.com" required
                                class="w-full pl-11 pr-2 py-2 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-900 outline-none focus:bg-white focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all font-sans">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2.5">
                    <div class="space-y-0.5">
                        <label class="text-[8px] font-bold text-gray-400 uppercase tracking-widest ml-1">Sandi</label>
                        <div class="relative group">
                            <div class="absolute left-2 top-1/2 -translate-y-1/2 flex items-center justify-center w-8 h-8 bg-gray-50 border border-gray-100 rounded-xl group-focus-within:bg-green-600 group-focus-within:text-white group-focus-within:border-green-600 transition-all duration-300 shadow-sm">
                                <span class="material-symbols-outlined text-[18px] font-light">key</span>
                            </div>
                            <input type="password" name="password" placeholder="••••" required
                                class="w-full pl-11 pr-2 py-2 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-900 outline-none focus:bg-white focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all font-sans">
                        </div>
                    </div>
                    <div class="space-y-0.5">
                        <label class="text-[8px] font-bold text-gray-400 uppercase tracking-widest ml-1">Ulangi</label>
                        <div class="relative group">
                            <div class="absolute left-2 top-1/2 -translate-y-1/2 flex items-center justify-center w-8 h-8 bg-gray-50 border border-gray-100 rounded-xl group-focus-within:bg-green-600 group-focus-within:text-white group-focus-within:border-green-600 transition-all duration-300 shadow-sm">
                                <span class="material-symbols-outlined text-[18px] font-light">verified</span>
                            </div>
                            <input type="password" name="password_confirmation" placeholder="••••" required
                                class="w-full pl-11 pr-2 py-2 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-900 outline-none focus:bg-white focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all font-sans">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 px-1 py-0.5">
                    <input type="checkbox" id="terms" required class="w-3 h-3 rounded-sm border-gray-200 text-green-600 focus:ring-green-100 cursor-pointer">
                    <label for="terms" class="text-[9px] font-semibold text-gray-400 cursor-pointer select-none">
                        Saya setuju dengan <a href="#" class="text-green-600 hover:underline">S&K & Privasi</a>.
                    </label>
                </div>

                <button type="submit" class="w-full py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-black text-xs uppercase tracking-widest shadow-md transition-all flex items-center justify-center gap-2">
                    Daftar sebagai Fotografer
                    <span class="material-symbols-outlined text-xs">photo_camera</span>
                </button>

                <div class="text-center">
                    <a href="{{ route('register') }}" class="text-[9px] font-bold text-gray-400 hover:text-blue-600 transition-colors uppercase tracking-wider">&larr; Daftar sebagai user biasa</a>
                </div>
            </form>

            <div class="mt-3 pt-3 border-t border-gray-100 text-center">
                <p class="text-[10px] font-semibold text-gray-400">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Masuk</a>
                </p>
            </div>
        </div>

        <p class="text-center text-[7px] font-bold text-gray-300 uppercase tracking-widest mt-3">
            &copy; 2026 KeJepret &bull; Step Up
        </p>
    </div>
</div>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection