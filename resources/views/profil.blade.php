@extends('layouts.app')
@section('title', 'Profil')
@section('content')

@php $user = auth()->user(); @endphp

<div class="max-w-2xl mx-auto px-4 sm:px-6 py-8">

    {{-- Profile Header --}}
    <div class="flex items-start gap-5 mb-8">
        <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 border-2 border-white shadow-md">
            <span class="text-2xl font-black text-blue-600">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
        </div>
        <div>
            <h1 class="text-2xl font-black text-gray-900 mb-0.5">{{ $user->name }}</h1>
            <p class="text-gray-400 text-sm font-semibold mb-2">{{ $user->email }}</p>
            <span class="inline-block bg-blue-50 text-blue-600 text-[11px] font-bold px-3 py-1 rounded-full border border-blue-100">
                {{ $user->role === 'runner' ? 'Pelari Aktif' : ucfirst($user->role) }}
            </span>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="grid grid-cols-3 gap-3 mb-8">
        <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm text-center">
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div class="text-xl font-black text-gray-900">{{ $totalFoto ?? 0 }}</div>
            <div class="text-[11px] text-gray-400 font-semibold">Foto Dibeli</div>
        </div>
        <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm text-center">
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div class="text-xl font-black text-gray-900">{{ $totalEvent ?? 0 }}</div>
            <div class="text-[11px] text-gray-400 font-semibold">Event</div>
        </div>
        <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm text-center">
            <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            <div class="text-xl font-black text-gray-900">{{ $totalOrder ?? 0 }}</div>
            <div class="text-[11px] text-gray-400 font-semibold">Order</div>
        </div>
    </div>

    {{-- Riwayat Pembelian --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-4">
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <h2 class="font-black text-gray-900 text-sm">Riwayat Pembelian</h2>
            </div>
            <a href="{{ route('order.history') }}" class="text-xs font-bold text-blue-600 hover:underline flex items-center gap-1">
                Lihat semua
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if(isset($recentOrders) && $recentOrders->count() > 0)
        <div class="space-y-4">
            @foreach($recentOrders as $order)
            <a href="{{ route('order.detail', $order->id) }}" class="flex items-center gap-3 hover:bg-gray-50 rounded-xl p-1 transition">
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-black text-gray-900 truncate">Order #{{ $order->id }}</p>
                    <p class="text-xs text-gray-400 font-semibold">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</p>
                </div>
                <span class="text-sm font-black text-blue-600 flex-shrink-0">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </a>
            @endforeach
        </div>
        @else
        <div class="text-center py-8">
            <p class="text-sm text-gray-400 font-semibold">Belum ada riwayat pembelian.</p>
            <a href="{{ route('runner.search') }}" class="inline-block mt-3 text-sm font-bold text-blue-600 hover:underline">Cari Foto Sekarang</a>
        </div>
        @endif
    </div>

    {{-- Upgrade Fotografer Banner --}}
    @if($user->role === 'runner')
    <div class="bg-blue-600 rounded-2xl p-6 mb-4 relative overflow-hidden">
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/10 rounded-full"></div>
        <div class="absolute -right-4 -bottom-8 w-24 h-24 bg-white/5 rounded-full"></div>
        <div class="relative z-10">
            <span class="inline-block bg-white/20 text-white text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full mb-4">Fitur Khusus</span>
            <h3 class="text-xl font-black text-white mb-2">Ingin Jadi Fotografer?</h3>
            <p class="text-white/75 text-sm leading-relaxed mb-5">Bergabunglah sebagai fotografer profesional dan dapatkan penghasilan dari setiap foto yang terjual.</p>
            <a href="{{ route('register.photographer') }}" class="inline-flex items-center gap-2 bg-white text-blue-600 font-bold text-sm px-6 py-2.5 rounded-xl hover:bg-blue-50 transition-colors shadow">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Daftar Sekarang
            </a>
        </div>
    </div>
    @endif

    {{-- Settings Menu --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm divide-y divide-gray-50 overflow-hidden">
        <a href="{{ route('order.history') }}" class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-50 transition-colors">
                    <svg class="w-4 h-4 text-gray-500 group-hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-900">Riwayat Order</p>
                    <p class="text-xs text-gray-400">Lihat semua transaksi pembelian</p>
                </div>
            </div>
            <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>

        <a href="{{ route('runner.search.history') }}" class="flex items-center justify-between p-4 hover:bg-gray-50 transition-colors group">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-50 transition-colors">
                    <svg class="w-4 h-4 text-gray-500 group-hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-900">Riwayat Pencarian</p>
                    <p class="text-xs text-gray-400">Histori pencarian foto AI</p>
                </div>
            </div>
            <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-between p-4 hover:bg-red-50 transition-colors group text-left">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center">
                        <svg class="w-4 h-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-red-500">Keluar</p>
                        <p class="text-xs text-gray-400">Logout dari akun ini</p>
                    </div>
                </div>
                <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
        </form>
    </div>

</div>
@endsection
