@extends('layouts.app')
@section('title', 'Semua Event')
@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">EVENT LARI</p>
        <h1 class="text-3xl sm:text-4xl font-black text-gray-900">Semua Event</h1>
        <p class="text-gray-500 text-sm mt-1">Temukan event lari favoritmu dan cari fotomu di dalamnya.</p>
    </div>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('event') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-6">
        <div class="flex flex-col sm:flex-row gap-3">

            {{-- Search --}}
            <div class="relative flex-1">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Cari nama event..."
                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-50 transition-all">
            </div>

            {{-- Kota --}}
            <div class="relative">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <input type="text" name="city" value="{{ request('city') }}"
                    placeholder="Kota..."
                    class="w-full sm:w-36 pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium placeholder-gray-400 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-50 transition-all">
            </div>

            {{-- Tanggal --}}
            <div class="relative">
                <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <input type="date" name="date" value="{{ request('date') }}"
                    class="w-full sm:w-40 pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium text-gray-600 focus:outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-50 transition-all">
            </div>

            {{-- Tombol --}}
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl transition-colors shadow-sm whitespace-nowrap">
                Cari
            </button>

            @if(request()->anyFilled(['q','city','date']))
            <a href="{{ route('event') }}"
                class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold text-sm rounded-xl transition-colors whitespace-nowrap flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                Reset
            </a>
            @endif

        </div>
    </form>

    {{-- Result Info --}}
    <div class="flex items-center justify-between mb-5">
        <p class="text-xs text-gray-400 font-semibold">
            {{ $events->total() }} event ditemukan
        </p>
        @if(request()->anyFilled(['q','city','date']))
        <div class="flex items-center gap-2 flex-wrap">
            @if(request('q'))
            <span class="flex items-center gap-1.5 text-xs font-bold text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1 rounded-full">
                "{{ request('q') }}"
            </span>
            @endif
            @if(request('city'))
            <span class="flex items-center gap-1.5 text-xs font-bold text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1 rounded-full">
                {{ request('city') }}
            </span>
            @endif
            @if(request('date'))
            <span class="flex items-center gap-1.5 text-xs font-bold text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1 rounded-full">
                {{ \Carbon\Carbon::parse(request('date'))->translatedFormat('d M Y') }}
            </span>
            @endif
        </div>
        @endif
    </div>

    {{-- Grid Events --}}
    @if($events->isEmpty())
    <div class="text-center py-24">
        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <p class="font-black text-gray-700 mb-1">Tidak ada event ditemukan</p>
        <p class="text-sm text-gray-400 mb-4">Coba ubah kata kunci atau reset filter.</p>
        <a href="{{ route('event') }}" class="text-sm font-bold text-blue-600 hover:underline">Reset Filter</a>
    </div>
    @else
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        @foreach($events as $event)
        <a href="{{ route('event.detail', $event->id) }}"
            class="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-xl hover:shadow-black/8 hover:-translate-y-1 transition-all duration-300">

            {{-- Cover --}}
            <div class="aspect-[4/3] overflow-hidden relative bg-gray-100">
                @if($event->cover_image)
                    <img src="{{ env('AWS_URL') }}/{{ $event->cover_image }}"
                         alt="{{ $event->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100">
                        <svg class="w-10 h-10 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif

                {{-- Badge foto count --}}
                <span class="absolute bottom-2.5 left-2.5 flex items-center gap-1 bg-black/60 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded-full">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ number_format($event->photos_count) }} foto
                </span>

                {{-- Badge lokasi --}}
                <span class="absolute top-2.5 right-2.5 flex items-center gap-1 bg-white/90 backdrop-blur-sm text-gray-700 text-[10px] font-bold px-2.5 py-1 rounded-full">
                    <svg class="w-3 h-3 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ Str::limit($event->location, 14) }}
                </span>
            </div>

            {{-- Info --}}
            <div class="p-4">
                <div class="flex items-center gap-1.5 text-gray-400 mb-1">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-[11px] font-semibold">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}</span>
                </div>
                <h3 class="font-black text-gray-900 text-sm leading-tight mb-3">{{ $event->name }}</h3>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-blue-600 group-hover:underline">Lihat Detail</span>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-blue-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($events->hasPages())
    <div class="flex items-center justify-center gap-2">
        {{-- Prev --}}
        @if($events->onFirstPage())
        <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-100 text-gray-300 cursor-not-allowed">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </span>
        @else
        <a href="{{ $events->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-600 hover:border-blue-400 hover:text-blue-600 transition-all">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </a>
        @endif

        {{-- Page Numbers --}}
        @foreach($events->getUrlRange(max(1, $events->currentPage()-2), min($events->lastPage(), $events->currentPage()+2)) as $page => $url)
        <a href="{{ $url }}"
            class="w-10 h-10 flex items-center justify-center rounded-xl text-sm font-bold transition-all
            {{ $page == $events->currentPage() ? 'bg-blue-600 text-white shadow-md shadow-blue-200' : 'bg-white border border-gray-200 text-gray-600 hover:border-blue-400 hover:text-blue-600' }}">
            {{ $page }}
        </a>
        @endforeach

        {{-- Next --}}
        @if($events->hasMorePages())
        <a href="{{ $events->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-600 hover:border-blue-400 hover:text-blue-600 transition-all">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
        @else
        <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-100 text-gray-300 cursor-not-allowed">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </span>
        @endif
    </div>
    @endif

    @endif

</div>
@endsection
