@extends('layouts.app')
@section('title', 'Statistik Penjualan')
@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 py-8">

    {{-- HEADER --}}
    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">FOTOGRAFER</p>
        <h1 class="text-3xl font-black text-gray-900">Statistik Penjualan</h1>
        <p class="text-gray-500 text-sm mt-1">Pantau performa foto dan pendapatan kamu.</p>
    </div>

    {{-- STATISTIK CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

        {{-- Total Foto --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="text-2xl font-black text-gray-900">{{ $totalFotos }}</p>
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mt-1">Total Foto</p>
        </div>

        {{-- Foto Tersedia --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-2xl font-black text-green-600">{{ $fotoTersedia }}</p>
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mt-1">Foto Tersedia</p>
        </div>

        {{-- Foto Terjual --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <p class="text-2xl font-black text-blue-600">{{ $fotoTerjual }}</p>
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mt-1">Foto Terjual</p>
        </div>

        {{-- Total Pendapatan --}}
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <div class="w-10 h-10 bg-yellow-50 rounded-xl flex items-center justify-center mb-3">
                <svg class="w-5 h-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-xl font-black text-yellow-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mt-1">Total Pendapatan</p>
        </div>

    </div>

    {{-- BULAN INI --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">

        <div class="bg-blue-600 rounded-2xl p-6 text-white">
            <p class="text-xs font-bold uppercase tracking-widest text-blue-200 mb-1">Penjualan Bulan Ini</p>
            <p class="text-4xl font-black">{{ $penjualanBulanIni }}</p>
            <p class="text-blue-200 text-sm mt-1">transaksi pada {{ now()->translatedFormat('F Y') }}</p>
        </div>

        <div class="bg-gray-900 rounded-2xl p-6 text-white">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-1">Pendapatan Bulan Ini</p>
            <p class="text-4xl font-black">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
            <p class="text-gray-400 text-sm mt-1">pada {{ now()->translatedFormat('F Y') }}</p>
        </div>

    </div>

    {{-- TABEL RIWAYAT PENJUALAN --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-sm font-black uppercase tracking-widest text-gray-900">Riwayat Penjualan</h2>
            <span class="text-xs text-gray-400 font-semibold">{{ $sales->count() }} transaksi</span>
        </div>

        @if($sales->isEmpty())
            <div class="py-16 text-center">
                <svg class="w-12 h-12 text-gray-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                <p class="text-gray-400 font-semibold text-sm">Belum ada foto yang terjual</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="text-left px-6 py-3 text-[10px] font-black uppercase tracking-widest text-gray-400">Foto</th>
                            <th class="text-left px-6 py-3 text-[10px] font-black uppercase tracking-widest text-gray-400">Kode Order</th>
                            <th class="text-left px-6 py-3 text-[10px] font-black uppercase tracking-widest text-gray-400">Kategori</th>
                            <th class="text-left px-6 py-3 text-[10px] font-black uppercase tracking-widest text-gray-400">Harga</th>
                            <th class="text-left px-6 py-3 text-[10px] font-black uppercase tracking-widest text-gray-400">Pendapatan</th>
                            <th class="text-left px-6 py-3 text-[10px] font-black uppercase tracking-widest text-gray-400">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($sales as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-700 text-xs">{{ Str::limit($item->filename, 30) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-lg">{{ $item->order_code }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-2 py-1 rounded-lg">
                                        {{ $item->category ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600 font-semibold text-xs">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-green-600 font-black text-xs">
                                        +Rp {{ number_format($item->photographer_amount, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-400 text-xs">
                                    {{ \Carbon\Carbon::parse($item->sold_at)->format('d M Y, H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- BACK --}}
    <div class="mt-6">
        <a href="{{ route('photographer.profil') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-gray-900 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Profil
        </a>
    </div>

</div>

@endsection