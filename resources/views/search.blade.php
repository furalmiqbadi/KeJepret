@extends('layouts.app')
@section('title', 'Cari Foto')
@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8 relative">
    {{-- Decorative Ambient Orbs --}}
    <div class="absolute top-10 -left-40 w-96 h-96 bg-sky-300/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 -right-40 w-[28rem] h-[28rem] bg-indigo-300/10 rounded-full blur-3xl pointer-events-none"></div>

    {{-- Header --}}
    <div class="mb-8 relative z-10">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">PENCARIAN</p>
        <h1 class="text-3xl sm:text-4xl font-black tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900">Cari Foto & Acara</h1>
        <p class="text-gray-500 text-sm mt-1">Pilih acara larimu, lalu cari fotomu di dalamnya.</p>
    </div>

    {{-- Manual Search Form --}}
    <form method="GET" action="{{ route('search') }}" class="mb-6 relative z-10">
        <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none z-10">
                <svg class="w-4 h-4 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" name="q" value="{{ request('q') }}"
                placeholder="Ketik nama acara atau kota..."
                class="w-full pl-11 pr-4 py-3.5 clean-glass-input rounded-2xl text-sm font-bold placeholder-slate-400 focus:outline-none transition-all shadow-sm shadow-slate-200/50">
        </div>
    </form>

    {{-- Result Count --}}
    <p class="text-xs text-slate-400 font-black uppercase tracking-wider mb-4 relative z-10">
        {{ number_format($events->count()) }} acara ditemukan
    </p>

    {{-- Results List --}}
    @if($events->isEmpty())
    <div class="text-center py-20 text-gray-400 relative z-10">
        <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        <p class="font-semibold text-sm">Tidak ada acara ditemukan</p>
        @if(request('q'))
        <a href="{{ route('search') }}" class="text-xs text-blue-600 font-bold mt-2 inline-block">Reset pencarian</a>
        @endif
    </div>
    @else
    <div class="space-y-3 relative z-10">
        @foreach($events as $event)
        <a href="{{ route('event.detail', $event->id) }}" class="group flex items-center gap-4 glass-card rounded-[2rem] p-4 hover:scale-[1.02] hover:-translate-y-0.5 transition-all duration-300">

            {{-- Thumbnail --}}
            <div class="w-16 h-16 rounded-2xl overflow-hidden flex-shrink-0 bg-slate-950/5 border border-slate-100/60">
                @if($event->cover_image)
                    <img src="{{ env('AWS_URL') }}/{{ $event->cover_image }}"
                         alt="{{ $event->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100">
                        <svg class="w-7 h-7 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-3 text-slate-400 mb-1">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-[10px] font-black uppercase tracking-wider">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-[10px] font-black uppercase tracking-wider">{{ Str::limit($event->location, 20) }}</span>
                    </div>
                </div>
                <h3 class="font-black text-slate-800 text-sm truncate mb-1 group-hover:text-sky-600 transition-colors">{{ $event->name }}</h3>
                <div class="flex items-center gap-1.5 text-slate-400">
                    <svg class="w-3.5 h-3.5 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-xs font-bold text-slate-500">{{ number_format($event->photos_count ?? 0) }} foto tersedia</span>
                </div>
            </div>

            <span class="w-8 h-8 rounded-xl bg-sky-50 flex items-center justify-center text-sky-600 group-hover:bg-gradient-to-r group-hover:from-sky-500 group-hover:to-indigo-600 group-hover:text-white transition-all duration-500 shadow-sm flex-shrink-0">
                <svg class="w-4 h-4 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </span>
        </a>
        @endforeach
    </div>
    @endif

</div>
@endsection
