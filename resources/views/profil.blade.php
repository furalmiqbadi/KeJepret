@extends('layouts.app')
@section('title', 'Profil')
@section('content')

@php $user = auth()->user(); @endphp

<div class="max-w-2xl mx-auto px-4 sm:px-6 py-8 relative z-10">

    {{-- Profile Header Card --}}
    <div class="glass-card rounded-[2rem] p-8 mb-6 flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-6 hover:translate-y-[-2px] transition-all duration-300">
        <div class="w-24 h-24 rounded-3xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center border border-white/30 shadow-[0_10px_25px_rgba(37,99,235,0.2)]">
            <span class="text-4xl font-black text-white italic tracking-tighter">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
        </div>
        <div class="flex-1">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-1">{{ $user->name }}</h1>
            <p class="text-slate-600 text-sm font-semibold mb-4">{{ $user->email }}</p>
            <span class="inline-block bg-blue-600/10 text-blue-600 text-xs font-black uppercase tracking-wider px-4 py-1.5 rounded-2xl border border-blue-500/15">
                {{ $user->role === 'runner' ? 'Pelari Aktif' : ucfirst($user->role) }}
            </span>
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

    {{-- Riwayat Pembelian (Glass Card) --}}
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

    {{-- Banner Upgrade Fotografer (Glossy Blue Glass) --}}
    @if($user->role === 'runner')
    <div class="glass-btn-blue rounded-[2rem] p-8 mb-6 relative overflow-hidden shadow-xl shadow-blue-500/10 hover:translate-y-[-2px] transition-all duration-300">
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/10 rounded-full"></div>
        <div class="absolute -right-4 -bottom-8 w-24 h-24 bg-white/5 rounded-full"></div>
        <div class="relative z-10">
            <span class="inline-block bg-white/20 text-white text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-full mb-4 border border-white/15">Fitur Khusus</span>
            <h3 class="text-2xl font-black text-white tracking-tight mb-2">Ingin Jadi Fotografer?</h3>
            <p class="text-white/80 text-sm leading-relaxed mb-6">Bergabunglah sebagai fotografer profesional dan dapatkan penghasilan dari setiap foto yang terjual.</p>
            <a href="{{ route('register.photographer') }}" class="inline-flex items-center gap-2 bg-white text-blue-600 font-black text-xs uppercase tracking-widest px-6 py-3.5 rounded-2xl hover:bg-blue-50 transition-all hover:shadow-lg active:scale-[0.98]">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Daftar Sekarang
            </a>
        </div>
    </div>
    @endif

    {{-- Menu List (Designed EXACTLY like User Reference Mockup) --}}
    <div class="backdrop-blur-3xl bg-slate-950/70 border border-white/10 rounded-[2.2rem] p-4 shadow-2xl space-y-2 hover:translate-y-[-2px] transition-all duration-300">
        
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
