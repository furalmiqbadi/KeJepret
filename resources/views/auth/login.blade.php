@php $hideNav = true; @endphp
@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="h-screen flex items-center justify-center px-4 overflow-hidden">
    <div class="w-full max-w-[340px] -mt-4">
        {{-- Header Login --}}
        <div class="text-center mb-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto mx-auto mb-1 object-contain">
            <h1 class="text-lg font-black text-gray-900 tracking-tight">Masuk KeJepret</h1>
        </div>

        {{-- Login Card --}}
        <div class="bg-white rounded-[1.5rem] p-4 border border-gray-100 shadow-lg relative overflow-hidden">
            <form action="{{ route('login') }}" method="POST" class="space-y-2.5 relative z-10">
                @csrf
                <div class="space-y-1.5">
                    <label class="text-[8px] font-bold text-gray-400 uppercase tracking-widest ml-1">Email</label>
                    <div class="relative group">
                        <div class="absolute left-2.5 top-1/2 -translate-y-1/2 flex items-center justify-center w-9 h-9 bg-gray-50 border border-gray-100 rounded-xl group-focus-within:bg-blue-600 group-focus-within:text-white group-focus-within:border-blue-600 transition-all duration-300 shadow-sm">
                            <span class="material-symbols-outlined text-[20px] font-light">mail</span>
                        </div>
                        <input type="email" name="email" placeholder="nama@email.com" required
                            class="w-full pl-13 pr-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl text-xs font-bold text-gray-900 outline-none focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all font-sans"
                            value="demo@kejepret.com">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <div class="flex items-center justify-between px-1">
                        <label class="text-[8px] font-bold text-gray-400 uppercase tracking-widest">Password</label>
                        <a href="#" class="text-[9px] font-bold text-blue-600 hover:underline">Lupa?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute left-2.5 top-1/2 -translate-y-1/2 flex items-center justify-center w-9 h-9 bg-gray-50 border border-gray-100 rounded-xl group-focus-within:bg-blue-600 group-focus-within:text-white group-focus-within:border-blue-600 transition-all duration-300 shadow-sm">
                            <span class="material-symbols-outlined text-[20px] font-light">key</span>
                        </div>
                        <input type="password" name="password" placeholder="••••••••" required
                            class="w-full pl-13 pr-4 py-3 bg-gray-50 border border-gray-100 rounded-2xl text-xs font-bold text-gray-900 outline-none focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all font-sans"
                            value="password">
                    </div>
                </div>

                <div class="flex items-center gap-2 px-1">
                    <input type="checkbox" id="remember" class="w-3.5 h-3.5 rounded border-gray-200 text-blue-600 focus:ring-blue-100 cursor-pointer">
                    <label for="remember" class="text-[10px] font-semibold text-gray-500 cursor-pointer select-none">Tetap masuk</label>
                </div>

                <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-blue-500/20 transition-all transform active:scale-[0.98] flex items-center justify-center gap-2 mt-1">
                    Masuk Sekarang
                    <span class="material-symbols-outlined text-sm">login</span>
                </button>
            </form>

            <div class="mt-4 pt-4 border-t border-gray-100 text-center">
                <p class="text-[10px] font-semibold text-gray-400">
                    Baru di sini? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar</a>
                </p>
            </div>
        </div>

        <p class="text-center text-[7px] font-bold text-gray-300 uppercase tracking-widest mt-4">
            &copy; 2026 KeJepret &bull; Aman
        </p>
    </div>
</div>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
@endsection
