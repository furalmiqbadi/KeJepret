@extends('layouts.app')
@section('title', 'Profil')
@section('content')

@php 
    $user = auth()->user(); 
    $hideNav = $user && $user->role === 'admin';
@endphp

<div class="max-w-6xl mx-auto px-4 sm:px-6 py-12 relative z-10">

    {{-- Background Ambient Elements --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-96 bg-gradient-to-b from-sky-100/50 to-transparent blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed -bottom-32 -left-32 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed top-1/4 -right-32 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    {{-- HEADER --}}
    <div class="mb-12 text-center animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 mb-4 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600">WORKSPACE PENGGUNA</p>
        </div>
        <h1 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight mb-2">Profil & Aktivitas</h1>
        <p class="text-sm sm:text-base font-semibold text-slate-500 max-w-xl mx-auto">Kelola identitas, pantau riwayat pembelian foto, dan dapatkan akses ke fitur khusus KeJepret.</p>
    </div>

    @if(session('success'))
    <div id="toast-success" class="glass-card bg-green-50/80 border border-green-200 text-green-700 px-6 py-5 rounded-[1.5rem] mb-8 shadow-sm flex items-start gap-4 animate-in fade-in slide-in-from-top-4 relative max-w-2xl mx-auto">
        <svg class="w-6 h-6 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="flex-1">
            <p class="text-sm font-black mb-1 tracking-wide">Berhasil!</p>
            <p class="text-xs font-bold">{{ session('success') }}</p>
        </div>
        <button onclick="dismissToast('toast-success')" class="text-green-400 hover:text-green-700 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    {{-- TWO COLUMN LAYOUT --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- LEFT COLUMN: Profile & Menu --}}
        <div class="lg:col-span-4 space-y-6 animate-in fade-in slide-in-from-left-8 duration-700 delay-100">
            
            {{-- Profile Card --}}
            <div class="glass-card rounded-[2.5rem] p-8 text-center relative overflow-hidden group border border-white/60 shadow-[0_20px_40px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_60px_rgba(37,99,235,0.08)] transition-all duration-500 bg-white/60 backdrop-blur-2xl">
                
                {{-- Cover background --}}
                <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-br from-blue-600 to-indigo-700"></div>

                {{-- Avatar --}}
                <div class="w-32 h-32 mx-auto rounded-[2rem] bg-slate-100 flex items-center justify-center shadow-xl mb-5 group-hover:scale-105 group-hover:-translate-y-1 transition-all duration-500 overflow-hidden relative border-[6px] border-white mt-12 z-10">
                    @if($user->profile_face_url)
                        <img src="{{ $user->profile_face_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center">
                            <span class="text-5xl font-black text-white italic tracking-tighter">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>
                
                <h2 class="text-2xl font-black text-slate-900 tracking-tight mb-1">{{ $user->name }}</h2>
                <p class="text-slate-500 text-sm font-semibold mb-4">{{ $user->email }}</p>

                <div class="flex justify-center gap-2 mb-8">
                    <span class="inline-block bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-blue-100 shadow-sm">
                        {{ $user->role === 'runner' ? 'Pelari Aktif' : ucfirst($user->role) }}
                    </span>
                </div>

                <a href="{{ route('profil.edit') }}" class="inline-flex w-full justify-center items-center gap-2 bg-slate-900 hover:bg-black text-white shadow-lg hover:shadow-xl shadow-slate-900/20 font-bold text-xs uppercase tracking-widest px-6 py-4 rounded-[1.25rem] transition-all hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    Edit Profil
                </a>
            </div>

            {{-- Menu Navigation --}}
            <div class="glass-card bg-white/70 backdrop-blur-2xl rounded-[2.5rem] p-3 shadow-xl shadow-slate-200/40 border border-white">
                <nav class="space-y-1">
                    @if($user->role !== 'admin')
                    <a href="{{ route('cart.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-white hover:shadow-sm text-slate-600 hover:text-blue-600 transition-all group font-bold">
                        <div class="w-10 h-10 rounded-[1rem] bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm tracking-wide flex-1">Lihat Keranjang</span>
                        <svg class="w-4 h-4 opacity-30 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    <div class="h-px bg-slate-200/50 my-2 mx-4"></div>
                    @endif

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-red-50 text-red-500 transition-all group font-bold">
                            <div class="w-10 h-10 rounded-[1rem] bg-red-100/50 text-red-500 flex items-center justify-center group-hover:scale-110 group-hover:bg-red-500 group-hover:text-white transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </div>
                            <span class="text-sm tracking-wide flex-1 text-left">Keluar Akun</span>
                        </button>
                    </form>
                </nav>
            </div>

        </div>

        {{-- RIGHT COLUMN: Activities & Features --}}
        <div class="lg:col-span-8 space-y-6 animate-in fade-in slide-in-from-right-8 duration-700 delay-200">
            
            {{-- Banner Upgrade Fotografer (Glossy Blue Glass) --}}
            @if($user->role === 'runner')
            <div class="glass-btn-blue rounded-[2.5rem] p-10 relative overflow-hidden shadow-xl shadow-blue-500/10 group">
                {{-- Decorative blobs --}}
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-colors duration-700"></div>
                <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-indigo-400/20 rounded-full blur-3xl group-hover:bg-indigo-300/30 transition-colors duration-700"></div>
                
                {{-- Glossy reflections --}}
                <div class="absolute top-0 left-0 w-full h-1/2 bg-gradient-to-b from-white/10 to-transparent pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/10 mb-4 shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-white">FITUR KHUSUS</p>
                        </div>
                        <h3 class="text-3xl font-black text-white tracking-tight mb-2">Ingin Jadi Fotografer?</h3>
                        <p class="text-white/80 text-sm leading-relaxed max-w-md">Bergabunglah sebagai fotografer profesional dan dapatkan penghasilan dari setiap foto yang Anda jual di platform ini.</p>
                    </div>

                    <div class="shrink-0">
                        <form id="logout-register-form" action="{{ route('logout.register.photographer') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin keluar dari akun saat ini untuk membuat akun fotografer baru?')) { document.getElementById('logout-register-form').submit(); }" 
                           class="inline-flex items-center justify-center gap-3 bg-white hover:bg-slate-50 text-blue-600 font-black text-xs uppercase tracking-widest px-8 py-5 rounded-2xl shadow-[0_10px_25px_rgba(255,255,255,0.2)] hover:shadow-[0_15px_35px_rgba(255,255,255,0.3)] hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- Card Khusus Admin / Riwayat Pembelian --}}
            @if($user->role === 'admin')
            <div class="glass-card bg-white/70 backdrop-blur-2xl rounded-[2.5rem] border border-white shadow-[0_20px_40px_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="p-10 flex flex-col md:flex-row items-center gap-8">
                    <div class="w-24 h-24 bg-gradient-to-br from-indigo-500 to-blue-600 text-white rounded-[1.5rem] flex items-center justify-center shrink-0 shadow-lg shadow-indigo-500/20 border border-indigo-400">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <h2 class="font-black text-slate-900 text-2xl tracking-tight mb-2">Halaman Admin</h2>
                        <p class="text-sm text-slate-500 font-semibold mb-6">Kelola event, pengguna, dan pengaturan sistem secara menyeluruh di Panel Admin.</p>
                        <a href="/admin" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-indigo-500/25 hover:shadow-xl hover:shadow-indigo-500/40 hover:-translate-y-1 transition-all">
                            Buka Admin Panel
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="glass-card bg-white/70 backdrop-blur-2xl rounded-[2.5rem] border border-white shadow-[0_20px_40px_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="px-8 py-7 border-b border-slate-100/60 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-50 rounded-[1rem] flex items-center justify-center text-blue-600 border border-blue-100/50">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h2 class="text-base font-black text-slate-900 tracking-tight">Riwayat Pembelian Terbaru</h2>
                    </div>
                    <a href="{{ route('order.history') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest transition-colors">
                        Lihat Semua
                    </a>
                </div>

                @if(isset($recentOrders) && $recentOrders->count() > 0)
                <div class="divide-y divide-slate-100/60">
                    @foreach($recentOrders as $order)
                        <a href="{{ route('order.detail', $order->id) }}" class="flex items-center gap-5 p-6 hover:bg-white/80 transition-colors group">
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 border border-blue-100/50 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-lg font-black text-slate-900 truncate mb-1">Order #{{ $order->id }}</p>
                                <p class="text-xs text-slate-500 font-bold flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-black text-blue-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Lunas</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                @else
                <div class="py-16 text-center px-4">
                    <div class="w-20 h-20 bg-blue-50 text-blue-300 rounded-[1.5rem] flex items-center justify-center mx-auto mb-5 border border-blue-100 shadow-inner">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-slate-500">Belum ada riwayat pembelian</p>
                    <p class="text-xs text-slate-400 mt-1 font-medium mb-6">Mulai eksplorasi event dan temukan foto terbaik Anda!</p>
                    <a href="{{ route('runner.search') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-black hover:shadow-lg hover:-translate-y-1 transition-all">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Cari Foto Sekarang
                    </a>
                </div>
                @endif
            </div>
            @endif

        </div>
    </div>

</div>

<script>
    function dismissToast(id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.style.opacity = '0';
        el.style.transform = 'translateY(-12px)';
        setTimeout(() => el.remove(), 400);
    }
    @if(session('success'))
    setTimeout(() => dismissToast('toast-success'), 5000);
    @endif
</script>
@endsection
