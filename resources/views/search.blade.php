@extends('layouts.app')
@section('title', 'Cari Foto')
@section('content')

@php
$events = [
    ['title'=>'Jakarta Marathon 2026',   'date'=>'15 Jun 2026','city'=>'Jakarta',   'photos'=>'2.340','img'=>'photo-1552674605-db6ffd4facb5'],
    ['title'=>'Bali Fun Run',            'date'=>'22 Jul 2026','city'=>'Bali',      'photos'=>'1.120','img'=>'photo-1571008887538-b36bb32f4571'],
    ['title'=>'Bandung Trail Run',       'date'=>'5 Agu 2026', 'city'=>'Bandung',   'photos'=>'890',  'img'=>'photo-1486218119243-13883505764c'],
    ['title'=>'Surabaya Night Run',      'date'=>'19 Agu 2026','city'=>'Surabaya',  'photos'=>'1.560','img'=>'photo-1461896836934-bd45ba8fcf9b'],
    ['title'=>'Yogyakarta Heritage Run', 'date'=>'2 Sep 2026', 'city'=>'Yogyakarta','photos'=>'780',  'img'=>'photo-1513593771513-7b58b6c4af38'],
    ['title'=>'Malang Mountain Run',     'date'=>'10 Sep 2026','city'=>'Malang',    'photos'=>'650',  'img'=>'photo-1594882645126-14020914d58d'],
    ['title'=>'Semarang City Run',       'date'=>'24 Sep 2026','city'=>'Semarang',  'photos'=>'920',  'img'=>'photo-1476480862126-209bfaa8edc8'],
    ['title'=>'Medan Fun Run',           'date'=>'8 Okt 2026', 'city'=>'Medan',     'photos'=>'540',  'img'=>'photo-1530549387789-4c1017266635'],
];
@endphp

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">PENCARIAN</p>
        <h1 class="text-3xl sm:text-4xl font-black text-gray-900">Cari Foto & Event</h1>
        <p class="text-gray-500 text-sm mt-1">Temukan foto larimu berdasarkan nama event, kota, atau fotografer.</p>
    </div>

    {{-- AI Selfie Search Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">
        <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-50">
            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
            </div>
            <div>
                <p class="font-bold text-gray-900 text-sm">Cari Foto dengan Selfie AI</p>
                <p class="text-xs text-gray-400">Unggah foto selfie, AI kami akan mencocokkan wajahmu dari ribuan foto event</p>
            </div>
        </div>
        {{-- Upload Area --}}
        <div class="p-5">
            <div class="border-2 border-dashed border-gray-200 rounded-xl p-10 text-center hover:border-blue-300 hover:bg-blue-50/30 transition-all cursor-pointer group">
                <div class="w-12 h-12 bg-gray-100 group-hover:bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3 transition-colors">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                </div>
                <p class="font-bold text-gray-700 text-sm mb-1">Unggah foto selfie kamu</p>
                <p class="text-xs text-gray-400 mb-3">Drag & drop atau klik untuk memilih foto</p>
                <div class="flex items-center justify-center gap-2 flex-wrap">
                    <span class="text-[10px] font-semibold text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full">JPG, PNG</span>
                    <span class="text-[10px] font-semibold text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full">Maks 10MB</span>
                    <span class="text-[10px] font-semibold text-blue-600 bg-blue-50 border border-blue-100 px-2.5 py-1 rounded-full flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Bisa pakai kamera
                    </span>
                </div>
                <input type="file" accept="image/*" class="hidden">
            </div>
        </div>
    </div>

    {{-- Divider --}}
    <div class="flex items-center gap-4 mb-6">
        <div class="flex-1 h-px bg-gray-200"></div>
        <span class="text-xs font-semibold text-gray-400">atau cari manual</span>
        <div class="flex-1 h-px bg-gray-200"></div>
    </div>

    {{-- Manual Search --}}
    <div class="relative mb-5">
        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <input type="text" placeholder="Ketik nama event, kota, atau fotografer..."
            class="w-full pl-11 pr-4 py-3.5 bg-white border border-gray-200 rounded-2xl text-sm font-medium placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100 shadow-sm transition-all">
    </div>

    {{-- City Filter Chips --}}
    <div class="flex flex-wrap gap-2 mb-5">
        @foreach(['Semua','Jakarta','Bali','Bandung','Surabaya','Yogyakarta','Malang','Semarang','Medan'] as $i => $city)
        <button class="px-4 py-1.5 rounded-full text-xs font-bold border transition-all {{ $i === 0 ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 border-gray-200 hover:border-blue-400 hover:text-blue-600' }}">
            {{ $city }}
        </button>
        @endforeach
    </div>

    {{-- Type Tabs --}}
    <div class="flex gap-1 mb-5">
        @foreach(['Event','Fotografer','Event Organizer'] as $i => $tab)
        <button class="px-4 py-2 text-xs font-bold rounded-xl transition-all {{ $i === 0 ? 'bg-white shadow-sm border border-gray-200 text-gray-900' : 'text-gray-500 hover:text-gray-700' }}">
            {{ $tab }}
        </button>
        @endforeach
    </div>

    <p class="text-xs text-gray-400 font-semibold mb-4">{{ count($events) }} hasil ditemukan</p>

    {{-- Results List --}}
    <div class="space-y-2">
        @foreach($events as $event)
        <a href="{{ route('kejepret') }}" class="group flex items-center gap-4 bg-white rounded-2xl p-4 border border-gray-100 hover:border-blue-200 hover:shadow-md hover:shadow-blue-100/40 transition-all">
            <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0">
                <img src="https://images.unsplash.com/{{ $event['img'] }}?w=128&h=128&q=80&fit=crop" alt="{{ $event['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-3 text-gray-400 mb-0.5">
                    <div class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-[11px] font-semibold">{{ $event['date'] }}</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-3 h-3 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-[11px] font-semibold">{{ $event['city'] }}</span>
                    </div>
                </div>
                <h3 class="font-black text-gray-900 text-sm truncate mb-0.5">{{ $event['title'] }}</h3>
                <div class="flex items-center gap-1.5 text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-xs font-semibold">{{ $event['photos'] }} foto tersedia</span>
                </div>
            </div>
            <svg class="w-5 h-5 text-gray-300 group-hover:text-blue-400 transition-colors flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
        @endforeach
    </div>

</div>
@endsection