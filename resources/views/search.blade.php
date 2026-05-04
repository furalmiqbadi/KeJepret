@extends('layouts.app')
@section('title', 'Cari Foto')
@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">PENCARIAN</p>
        <h1 class="text-3xl sm:text-4xl font-black text-gray-900">Cari Foto & Event</h1>
        <p class="text-gray-500 text-sm mt-1">Pilih event larimu, lalu cari fotomu di dalamnya.</p>
    </div>

    {{-- Manual Search Form --}}
    <form method="GET" action="{{ route('search') }}" class="mb-5">
        <div class="relative">
            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="q" value="{{ request('q') }}"
                placeholder="Ketik nama event atau kota..."
                class="w-full pl-11 pr-4 py-3.5 bg-white border border-gray-200 rounded-2xl text-sm font-medium placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100 shadow-sm transition-all">
        </div>
    </form>

    {{-- Result Count --}}
    <p class="text-xs text-gray-400 font-semibold mb-4">
        {{ $events->count() }} event ditemukan
    </p>

    {{-- Results List --}}
    @if($events->isEmpty())
    <div class="text-center py-20 text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        <p class="font-semibold text-sm">Tidak ada event ditemukan</p>
        @if(request('q'))
        <a href="{{ route('search') }}" class="text-xs text-blue-600 font-bold mt-2 inline-block">Reset pencarian</a>
        @endif
    </div>
    @else
    <div class="space-y-2">
        @foreach($events as $event)
        <a href="{{ route('event.detail', $event->id) }}" class="group flex items-center gap-4 bg-white rounded-2xl p-4 border border-gray-100 hover:border-blue-200 hover:shadow-md hover:shadow-blue-100/40 transition-all">

            {{-- Thumbnail --}}
            <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                @if($event->cover_image)
                    <img src="{{ env('AWS_URL') }}/{{ $event->cover_image }}"
                         alt="{{ $event->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-7 h-7 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-3 text-gray-400 mb-0.5">
                    <div class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-[11px] font-semibold">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-3 h-3 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-[11px] font-semibold">{{ Str::limit($event->location, 20) }}</span>
                    </div>
                </div>
                <h3 class="font-black text-gray-900 text-sm truncate mb-0.5">{{ $event->name }}</h3>
                <div class="flex items-center gap-1.5 text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-xs font-semibold">{{ $event->photos_count ?? 0 }} foto tersedia</span>
                </div>
            </div>

            <svg class="w-5 h-5 text-gray-300 group-hover:text-blue-400 transition-colors flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
        @endforeach
    </div>
    @endif

</div>
@endsection
