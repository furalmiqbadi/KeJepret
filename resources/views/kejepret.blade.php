@extends('layouts.app')
@section('title', 'Event')
@section('content')

@php
$events = [
    ['title'=>'Jakarta Marathon 2026',   'date'=>'15 Jun 2026','city'=>'Jakarta',   'photos'=>'2.340','img'=>'photo-1552674605-db6ffd4facb5','hot'=>true],
    ['title'=>'Bali Fun Run',            'date'=>'22 Jul 2026','city'=>'Bali',      'photos'=>'1.120','img'=>'photo-1571008887538-b36bb32f4571','hot'=>false],
    ['title'=>'Bandung Trail Run',       'date'=>'5 Agu 2026', 'city'=>'Bandung',   'photos'=>'890',  'img'=>'photo-1486218119243-13883505764c','hot'=>false],
    ['title'=>'Surabaya Night Run',      'date'=>'19 Agu 2026','city'=>'Surabaya',  'photos'=>'1.560','img'=>'photo-1461896836934-bd45ba8fcf9b','hot'=>true],
    ['title'=>'Yogyakarta Heritage Run', 'date'=>'2 Sep 2026', 'city'=>'Yogyakarta','photos'=>'780',  'img'=>'photo-1513593771513-7b58b6c4af38','hot'=>false],
    ['title'=>'Malang Mountain Run',     'date'=>'10 Sep 2026','city'=>'Malang',    'photos'=>'650',  'img'=>'photo-1594882645126-14020914d58d','hot'=>false],
    ['title'=>'Semarang City Run',       'date'=>'24 Sep 2026','city'=>'Semarang',  'photos'=>'920',  'img'=>'photo-1476480862126-209bfaa8edc8','hot'=>false],
    ['title'=>'Medan Fun Run',           'date'=>'8 Okt 2026', 'city'=>'Medan',     'photos'=>'540',  'img'=>'photo-1530549387789-4c1017266635','hot'=>false],
];
@endphp

<div class="max-w-5xl mx-auto px-4 sm:px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">CARI FOTO KAMU</p>
        <h1 class="text-3xl sm:text-4xl font-black text-gray-900">KeJepret — Event Lari</h1>
        <p class="text-gray-500 text-sm mt-1">Temukan jepretan terbaikmu dari setiap event lari di Indonesia.</p>
    </div>

    {{-- Search + Filter Bar --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-3">
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1 relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" placeholder="Cari event..."
                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:bg-white focus:ring-4 focus:ring-blue-100 transition-all">
            </div>
            <select class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm font-semibold text-gray-700 focus:outline-none focus:border-blue-400 transition-all min-w-[140px]">
                <option>Semua Kota</option>
                <option>Jakarta</option><option>Bali</option><option>Bandung</option>
                <option>Surabaya</option><option>Yogyakarta</option><option>Malang</option>
                <option>Semarang</option><option>Medan</option>
            </select>
            {{-- Sort Pills --}}
            <div class="flex gap-2">
                <button class="flex items-center gap-1.5 bg-blue-600 text-white text-xs font-bold px-4 py-3 rounded-xl transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Terbaru
                </button>
                <button class="flex items-center gap-1.5 bg-gray-100 text-gray-500 text-xs font-bold px-4 py-3 rounded-xl hover:bg-gray-200 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    Terpopuler
                </button>
                <button class="hidden sm:flex items-center gap-1.5 bg-gray-100 text-gray-500 text-xs font-bold px-4 py-3 rounded-xl hover:bg-gray-200 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Mendatang
                </button>
            </div>
        </div>
    </div>

    <p class="text-xs text-gray-400 font-semibold mb-6">{{ count($events) }} event ditemukan</p>

    {{-- Events Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($events as $event)
        <a href="#" class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl hover:shadow-black/8 hover:-translate-y-1 transition-all duration-300">
            <div class="aspect-[4/3] overflow-hidden relative">
                <img src="https://images.unsplash.com/{{ $event['img'] }}?w=400&h=300&q=80&fit=crop"
                    alt="{{ $event['title'] }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @if($event['hot'])
                <span class="absolute top-2.5 left-2.5 flex items-center gap-1 bg-orange-500 text-white text-[10px] font-black px-2.5 py-1 rounded-full shadow">
                    🔥 Populer
                </span>
                @endif
                <span class="absolute top-2.5 right-2.5 flex items-center gap-1 bg-white/90 backdrop-blur-sm text-gray-700 text-[10px] font-bold px-2.5 py-1 rounded-full shadow-sm">
                    <svg class="w-3 h-3 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $event['city'] }}
                </span>
            </div>
            <div class="p-4">
                <div class="flex items-center gap-1.5 text-gray-400 mb-1.5">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-[11px] font-semibold">{{ $event['date'] }}</span>
                </div>
                <h3 class="font-black text-gray-900 text-sm leading-tight mb-2">{{ $event['title'] }}</h3>
                <div class="flex items-center gap-1.5 text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-xs font-semibold">{{ $event['photos'] }} foto</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

</div>
@endsection