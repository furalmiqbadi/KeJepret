@extends('layouts.app')
@section('title', 'Koleksi')
@section('content')

@if(isset($penjualan))
@php
// Data untuk fotografer
@endphp

<div class="max-w-5xl mx-auto px-4 sm:px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-widest text-green-600 mb-1">MANAGE PENJUALAN</p>
        <h1 class="text-3xl sm:text-4xl font-black text-gray-900">Koleksi Fotografer</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola foto yang dijual, atur harga, dan lihat laporan penjualan.</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-3 gap-4 mb-8">
        @php
        $totalFoto = count($penjualan);
        $totalTerjual = array_sum(array_column($penjualan, 'terjual'));
        $totalPendapatan = array_sum(array_column($penjualan, 'pendapatan'));
        @endphp
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm text-center">
            <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div class="text-2xl font-black text-gray-900 mb-0.5">{{ $totalFoto }}</div>
            <div class="text-xs text-gray-400 font-semibold">Total Foto Dijual</div>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm text-center">
            <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/></svg>
            </div>
            <div class="text-2xl font-black text-gray-900 mb-0.5">Rp {{ number_format($totalPendapatan) }}</div>
            <div class="text-xs text-gray-400 font-semibold">Total Pendapatan</div>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm text-center">
            <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            <div class="text-2xl font-black text-gray-900 mb-0.5">{{ $totalTerjual }}</div>
            <div class="text-xs text-gray-400 font-semibold">Total Terjual</div>
        </div>
    </div>

    {{-- Photo Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($penjualan as $foto)
        <div class="group relative bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-black/10 transition-all duration-300">
            <div class="aspect-[3/2] overflow-hidden relative">
                <img
                    src="https://images.unsplash.com/{{ $foto['img'] }}?w=600&h=400&q=85&fit=crop"
                    alt="{{ $foto['event'] }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                >
                {{-- Harga Badge --}}
                <div class="absolute top-3 right-3 bg-green-600 text-white text-[10px] font-black px-2 py-1 rounded-full">
                    Rp {{ number_format($foto['harga']) }}
                </div>
                {{-- Hover overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 gap-2">
                    <button class="flex items-center justify-center gap-2 w-full bg-green-600 text-white font-bold text-xs py-2.5 rounded-xl hover:bg-green-500 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Harga
                    </button>
                    <button class="flex items-center justify-center gap-2 w-full bg-red-600 text-white font-bold text-xs py-2.5 rounded-xl hover:bg-red-500 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Hapus Foto
                    </button>
                </div>
                {{-- Event label --}}
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                    <p class="text-white text-xs font-bold">{{ $foto['event'] }}</p>
                    <p class="text-white text-[10px] opacity-80">Terjual: {{ $foto['terjual'] }} | Pendapatan: Rp {{ number_format($foto['pendapatan']) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@else

@php
$koleksi = $koleksi ?? [
    ['event'=>'Jakarta Marathon 2026','img'=>'photo-1552674605-db6ffd4facb5','km'=>'42K'],
    ['event'=>'Surabaya Night Run',   'img'=>'photo-1461896836934-bd45ba8fcf9b','km'=>'10K'],
    ['event'=>'Bali Fun Run',         'img'=>'photo-1571008887538-b36bb32f4571','km'=>'5K'],
    ['event'=>'Jakarta Marathon 2026','img'=>'photo-1486218119243-13883505764c','km'=>'42K'],
    ['event'=>'Surabaya Night Run',   'img'=>'photo-1594882645126-14020914d58d','km'=>'10K'],
    ['event'=>'Bali Fun Run',         'img'=>'photo-1513593771513-7b58b6c4af38','km'=>'5K'],
];
@endphp

<div class="max-w-5xl mx-auto px-4 sm:px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">FOTO SAYA</p>
        <h1 class="text-3xl sm:text-4xl font-black text-gray-900">Koleksi</h1>
        <p class="text-gray-500 text-sm mt-1">Daftar foto yang sudah kamu beli dari berbagai event lari.</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-3 gap-4 mb-8">
        @foreach([
            ['icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'val'=>'12', 'label'=>'Total Foto'],
            ['icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'val'=>'3', 'label'=>'Event Diikuti'],
            ['icon'=>'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'val'=>'2', 'label'=>'Tahun Aktif'],
        ] as $stat)
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm text-center">
            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/></svg>
            </div>
            <div class="text-2xl font-black text-gray-900 mb-0.5">{{ $stat['val'] }}</div>
            <div class="text-xs text-gray-400 font-semibold">{{ $stat['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Filter Chips --}}
    <div class="flex flex-wrap gap-2 mb-6">
        @foreach(['Semua','Jakarta Marathon 2026','Surabaya Night Run','Bali Fun Run'] as $i => $filter)
        <button class="px-4 py-1.5 rounded-full text-xs font-bold border transition-all {{ $i === 0 ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-200 hover:border-blue-400 hover:text-blue-600' }}">
            {{ $filter }}
        </button>
        @endforeach
    </div>

    {{-- Photo Grid 3 columns --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($koleksi as $foto)
        <div class="group relative bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-black/10 transition-all duration-300 cursor-pointer">
            <div class="aspect-[3/2] overflow-hidden relative">
                <img
                    src="https://images.unsplash.com/{{ $foto['img'] }}?w=600&h=400&q=85&fit=crop"
                    alt="{{ $foto['event'] }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                >
                {{-- KM Badge --}}
                <div class="absolute top-3 right-3 w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center shadow-lg">
                    <span class="text-white text-[10px] font-black">{{ $foto['km'] }}</span>
                </div>
                {{-- Hover overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 gap-2">
                    <button class="flex items-center justify-center gap-2 w-full bg-blue-600 text-white font-bold text-xs py-2.5 rounded-xl hover:bg-blue-500 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh Foto
                    </button>
                    <button class="flex items-center justify-center gap-2 w-full bg-white/20 backdrop-blur-sm text-white font-bold text-xs py-2.5 rounded-xl border border-white/30 hover:bg-white/30 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                        Bagikan
                    </button>
                </div>
                {{-- Event label at bottom --}}
                <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/70 to-transparent p-3 translate-y-0 group-hover:opacity-0 transition-opacity">
                    <p class="text-white text-xs font-bold">{{ $foto['event'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endif

@endsection