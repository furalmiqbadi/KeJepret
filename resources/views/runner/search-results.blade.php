@extends('layouts.app')
@section('title', 'Hasil Pencarian')
@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">

    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">HASIL AI SEARCH</p>
            <h1 class="text-3xl font-black text-gray-900">Foto Ditemukan</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $photos->count() }} foto cocok dengan wajahmu.</p>
        </div>
        <a href="{{ route('runner.search') }}" class="flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-blue-600 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Cari Lagi
        </a>
    </div>

    @if($photos->isEmpty())
    <div class="text-center py-24">
        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <p class="font-black text-gray-400 text-lg">Tidak ada foto ditemukan</p>
        <p class="text-gray-400 text-sm mt-1">Coba upload selfie dengan pencahayaan lebih baik.</p>
        <a href="{{ route('runner.search') }}" class="inline-block mt-4 px-6 py-3 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition">Coba Lagi</a>
    </div>
    @else
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @foreach($photos as $photo)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md hover:border-blue-200 transition-all group">

            {{-- Foto Watermark --}}
            <div class="relative aspect-square overflow-hidden">
                <img src="{{ $photo['watermark_url'] }}" alt="Foto"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute top-2 right-2 bg-black/60 text-white text-[10px] font-black px-2 py-1 rounded-full">
                    {{ round($photo['similarity_score']) }}%
                </div>
            </div>

            {{-- Info --}}
            <div class="p-3 space-y-1">
                <p class="text-xs font-bold text-gray-900 truncate">{{ $photo['event_name'] }}</p>
                <p class="text-[11px] text-gray-400 font-semibold">{{ $photo['photographer'] }}</p>
                <p class="text-sm font-black text-blue-600">Rp {{ number_format($photo['price'], 0, ',', '.') }}</p>
            </div>

            {{-- Tombol Keranjang --}}
            <div class="px-3 pb-3">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="photo_id" value="{{ $photo['photo_id'] }}">
                    <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded-xl font-bold text-xs hover:bg-blue-700 active:scale-95 transition-all flex items-center justify-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Aksi bawah --}}
    <div class="mt-8 flex items-center justify-between">
        <a href="{{ route('runner.search') }}" class="text-sm font-bold text-gray-500 hover:text-blue-600 transition-colors">Cari Lagi</a>
        <a href="{{ route('cart.index') }}" class="flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-500/20">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            Lihat Keranjang
        </a>
    </div>
    @endif

</div>
@endsection
