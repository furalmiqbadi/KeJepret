@extends('layouts.app')
@section('title', 'Profil')
@section('content')

@php $user = auth()->user(); @endphp

<div class="max-w-2xl mx-auto px-4 sm:px-6 py-8 relative z-10">

    @if(session('success'))
    <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-2xl mb-6 font-bold text-sm text-center">
        {{ session('success') }}
    </div>
    @endif

    {{-- Profile Header Card --}}
    <div class="glass-card rounded-[2.5rem] p-8 md:p-12 mb-8 relative overflow-hidden shadow-2xl hover:shadow-blue-500/10 transition-all duration-500">
        {{-- Ambient decorative glow --}}
        <div class="absolute -top-32 -right-32 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-center md:items-start text-center md:text-left gap-8">
            {{-- Avatar Section --}}
            <div class="w-36 h-36 rounded-[2.5rem] bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center border-[6px] border-white shadow-[0_15px_35px_rgba(37,99,235,0.25)] flex-shrink-0 relative group cursor-pointer overflow-hidden transition-transform duration-500 hover:scale-105">
                @if($user->profile_face_url)
                    <img src="{{ $user->profile_face_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                @else
                    <span class="text-6xl font-black text-white italic tracking-tighter">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                @endif
            </div>

            <div class="flex-1 flex flex-col sm:flex-row items-center sm:items-start justify-between w-full pt-2">
                <div class="mb-6 sm:mb-0 flex flex-col items-center sm:items-start">
                    <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-2">{{ $user->name }}</h1>
                    <p class="text-slate-600 text-sm font-semibold mb-5">{{ $user->email }}</p>
                    <span class="inline-block bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-blue-100 shadow-sm">
                        {{ $user->role === 'runner' ? 'Pelari Aktif' : ucfirst($user->role) }}
                    </span>
                </div>
                <a href="{{ route('profil.edit') }}" class="inline-flex items-center justify-center gap-2 bg-white/60 hover:bg-white text-slate-700 hover:text-blue-600 font-bold text-xs uppercase tracking-widest px-6 py-3.5 rounded-2xl border border-slate-200/60 hover:border-blue-200 transition-all shadow-sm">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    Edit Profil
                </a>
            </div>
        </div>
        <div class="text-3xl font-black text-gray-900 mb-0.5">Rp 0</div>
        <p class="text-gray-400 text-xs mb-5">Saldo tersedia</p>
        <div class="flex gap-3">
            <button class="flex-1 flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm py-3 rounded-xl transition-colors shadow-sm shadow-blue-200">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                Top Up
            </button>
            <button class="flex-1 bg-white hover:bg-gray-50 text-gray-700 font-bold text-sm py-3 rounded-xl border border-gray-200 transition-colors">
                Tarik Dana
            </button>
        </div>
    </div>

    {{-- Card Khusus Admin / Riwayat Pembelian --}}
    @if($user->role === 'admin')
    <div class="glass-card rounded-[2rem] p-8 mb-6 hover:translate-y-[-2px] transition-all duration-300">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-indigo-600/15 text-indigo-600 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h2 class="font-black text-slate-900 text-base tracking-tight">Halaman Admin</h2>
        </div>
        <div class="text-center py-4">
            <p class="text-sm text-slate-500 font-bold mb-4">Kelola event, pengguna, dan data sistem lainnya di Panel Admin.</p>
            <a href="/admin" class="inline-block px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-xl font-bold text-xs uppercase tracking-widest hover:shadow-lg hover:shadow-indigo-500/25 transition">Buka Admin Panel</a>
        </div>
    </div>
    @else
    <div class="glass-card rounded-[2rem] p-8 mb-6 hover:translate-y-[-2px] transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600/15 text-blue-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h2 class="font-black text-slate-900 text-base tracking-tight">Riwayat Pembelian</h2>
            </div>
            <a href="{{ route('order.history') }}" class="text-xs font-black uppercase tracking-widest text-blue-600 hover:text-blue-700 flex items-center gap-1 transition-colors">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if(isset($recentOrders) && $recentOrders->count() > 0)
        <div class="space-y-3">
            @foreach($recentOrders as $order)
            <a href="{{ route('order.detail', $order->id) }}" class="flex items-center gap-4 bg-white/20 hover:bg-white/50 border border-white/25 rounded-2xl p-4 transition-all hover:scale-[1.01]">
                <div class="w-12 h-12 rounded-xl bg-blue-600/10 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-black text-slate-900 truncate">Order #{{ $order->id }}</p>
                    <p class="text-[11px] text-slate-500 font-bold">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y') }}</p>
                </div>
                <span class="text-sm font-black text-blue-600 flex-shrink-0">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </a>
            @endforeach
        </div>
        @else
        <div class="text-center py-8">
            <p class="text-sm text-slate-500 font-bold">Belum ada riwayat pembelian.</p>
            <a href="{{ route('runner.search') }}" class="inline-block mt-4 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-bold text-xs uppercase tracking-widest hover:shadow-lg hover:shadow-blue-500/25 transition">Cari Foto Sekarang</a>
        </div>
        @endif
    </div>
    @endif

    {{-- Banner Upgrade Fotografer (Glossy Blue Glass) --}}
    @if($user->role === 'runner')
    <div class="glass-btn-blue rounded-[2rem] p-8 mb-6 relative overflow-hidden shadow-xl shadow-blue-500/10 hover:translate-y-[-2px] transition-all duration-300">
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/10 rounded-full"></div>
        <div class="absolute -right-4 -bottom-8 w-24 h-24 bg-white/5 rounded-full"></div>
        <div class="relative z-10">
            <span class="inline-block bg-white/20 text-white text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-full mb-4 border border-white/15">Fitur Khusus</span>
            <h3 class="text-2xl font-black text-white tracking-tight mb-2">Ingin Jadi Fotografer?</h3>
            <p class="text-white/80 text-sm leading-relaxed mb-6">Bergabunglah sebagai fotografer profesional dan dapatkan penghasilan dari setiap foto yang terjual.</p>
            
            <form id="logout-register-form" action="{{ route('logout.register.photographer') }}" method="POST" class="hidden">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin keluar dari akun saat ini untuk membuat akun fotografer baru?')) { document.getElementById('logout-register-form').submit(); }" class="inline-flex items-center gap-2 bg-white text-blue-600 font-black text-xs uppercase tracking-widest px-6 py-3.5 rounded-2xl hover:bg-blue-50 transition-all hover:shadow-lg active:scale-[0.98] cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Daftar Sekarang
            </a>
        </div>
    </div>
    @endif

    {{-- Menu List (Designed EXACTLY like User Reference Mockup) --}}
    <div class="backdrop-blur-3xl bg-slate-950/70 border border-white/10 rounded-[2.2rem] p-4 shadow-2xl space-y-2 hover:translate-y-[-2px] transition-all duration-300">
        
        @if($user->role !== 'admin')
        {{-- Dashboard / Order History --}}
        <a href="{{ route('order.history') }}" 
           class="flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300 group
                  {{ Route::is('order.history') ? 'bg-white text-slate-900 shadow-xl font-bold' : 'text-white/85 hover:bg-white hover:text-slate-900' }}">
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="text-sm font-bold tracking-wide">Riwayat Order</span>
            </div>
            <svg class="w-4 h-4 opacity-50 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
        @endif

        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300 group text-left text-red-400 hover:bg-red-500 hover:text-white">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span class="text-sm font-bold tracking-wide">Keluar</span>
                </div>
                <svg class="w-4 h-4 opacity-50 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </form>

    </div>

</div>
@endsection
