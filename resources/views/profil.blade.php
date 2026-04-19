@extends('layouts.app')
@section('title', 'Profil')
@section('content')

<div class="max-w-2xl mx-auto px-4 sm:px-6 py-8">

    {{-- Profile Header --}}
    <div class="flex items-start gap-5 mb-8">
        <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center flex-shrink-0 border-2 border-white shadow-md">
            <span class="text-2xl font-black text-gray-500">U</span>
        </div>
        <div>
            <h1 class="text-2xl font-black text-gray-900 mb-0.5">Nama Pengguna</h1>
            <p class="text-gray-400 text-sm font-semibold mb-2">pengguna@email.com</p>
            <span class="inline-block bg-blue-50 text-blue-600 text-[11px] font-bold px-3 py-1 rounded-full border border-blue-100">Pelari Aktif</span>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="grid grid-cols-3 gap-3 mb-8">
        @foreach([
            ['icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z','val'=>'12','label'=>'Foto Dibeli'],
            ['icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z','val'=>'3','label'=>'Event'],
            ['icon'=>'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z','val'=>'Rp 0','label'=>'Saldo'],
        ] as $s)
        <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm text-center">
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-2">
                <svg class="w-4.5 h-4.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}"/></svg>
            </div>
            <div class="text-xl font-black text-gray-900">{{ $s['val'] }}</div>
            <div class="text-[11px] text-gray-400 font-semibold">{{ $s['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Saldo Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-4">
        <div class="flex items-start justify-between mb-1">
            <p class="text-[11px] font-bold uppercase tracking-widest text-blue-600">SALDO</p>
            <div class="w-8 h-8 bg-gray-50 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
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

    {{-- Riwayat Pembelian --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-4">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <h2 class="font-black text-gray-900 text-sm">Riwayat Pembelian</h2>
            </div>
            <a href="{{ route('koleksi') }}" class="text-xs font-bold text-blue-600 hover:underline flex items-center gap-1">
                Lihat semua <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="space-y-4">
            @foreach([
                ['event'=>'Jakarta Marathon 2026','tgl'=>'10 Apr 2026','harga'=>'Rp 25.000','img'=>'photo-1552674605-db6ffd4facb5'],
                ['event'=>'Surabaya Night Run',   'tgl'=>'3 Mar 2026', 'harga'=>'Rp 20.000','img'=>'photo-1461896836934-bd45ba8fcf9b'],
                ['event'=>'Bali Fun Run',          'tgl'=>'15 Feb 2026','harga'=>'Rp 20.000','img'=>'photo-1571008887538-b36bb32f4571'],
            ] as $item)
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100">
                    <img src="https://images.unsplash.com/{{ $item['img'] }}?w=96&h=96&q=80&fit=crop" alt="" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-black text-gray-900 truncate">{{ $item['event'] }}</p>
                    <p class="text-xs text-gray-400 font-semibold">{{ $item['tgl'] }}</p>
                </div>
                <span class="text-sm font-black text-blue-600 flex-shrink-0">{{ $item['harga'] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Upgrade Fotografer Banner --}}
    <div class="bg-blue-600 rounded-2xl p-6 mb-4 relative overflow-hidden">
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/10 rounded-full"></div>
        <div class="absolute -right-4 -bottom-8 w-24 h-24 bg-white/5 rounded-full"></div>
        <div class="relative z-10">
            <span class="inline-block bg-white/20 text-white text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full mb-4">Fitur Khusus</span>
            <h3 class="text-xl font-black text-white mb-2">Ingin Jadi Fotografer?</h3>
            <p class="text-white/75 text-sm leading-relaxed mb-5">Bergabunglah sebagai fotografer profesional dan dapatkan penghasilan dari setiap foto yang terjual.</p>
            <button class="inline-flex items-center gap-2 bg-white text-blue-600 font-bold text-sm px-6 py-2.5 rounded-xl hover:bg-blue-50 transition-colors shadow">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Daftar Sekarang
            </button>
        </div>
    </div>

    {{-- Settings Menu --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm divide-y divide-gray-50 overflow-hidden">
        {{-- Notifikasi --}}
        <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-50 transition-colors">
                    <svg class="w-4.5 h-4.5 text-gray-500 group-hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-900">Notifikasi</p>
                    <p class="text-xs text-gray-400">Atur preferensi notifikasi</p>
                </div>
            </div>
            <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
        {{-- Keamanan --}}
        <a href="#" class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-50 transition-colors">
                    <svg class="w-4.5 h-4.5 text-gray-500 group-hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-900">Keamanan</p>
                    <p class="text-xs text-gray-400">Password dan autentikasi</p>
                </div>
            </div>
            <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
        {{-- Keluar (merah) --}}
        <form action="{{ route('logout') }}" method="POST" id="logout-form" class="hidden">
            @csrf
        </form>
        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
           class="w-full flex items-center justify-between p-4 hover:bg-red-50 transition-colors group text-left outline-none border-none bg-transparent">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center">
                    <svg class="w-4.5 h-4.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-red-600">Keluar</p>
                    <p class="text-xs text-gray-400 font-semibold">Logout dari akun ini</p>
                </div>
            </div>
            <svg class="w-4 h-4 text-gray-300 group-hover:text-red-300 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>

</div>
@endsection