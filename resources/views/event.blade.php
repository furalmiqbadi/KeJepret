@extends('layouts.app')
@section('title', 'Semua Acara')
@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 pt-2 sm:pt-24 pb-8 sm:pb-12 relative">
    {{-- Decorative Ambient Orbs --}}
    <div class="absolute top-20 -left-40 w-96 h-96 bg-sky-300/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-[40%] -right-40 w-[28rem] h-[28rem] bg-indigo-300/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 -left-20 w-80 h-80 bg-blue-300/5 rounded-full blur-3xl pointer-events-none"></div>

    {{-- Header dengan Ambient Glow --}}
    <div class="mb-14 text-center relative z-10">
        <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-48 h-12 bg-blue-400/20 rounded-full blur-2xl pointer-events-none"></div>
        <p class="text-[10px] font-black uppercase tracking-[0.25em] text-blue-600 mb-2 drop-shadow-sm">Jelajahi Acara</p>
        <h1 class="text-4xl sm:text-5xl font-black tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-600 drop-shadow-sm mb-4">Semua Acara</h1>
        <p class="text-slate-500 text-sm max-w-md mx-auto leading-relaxed font-medium">Temukan acara lari terfavoritmu dan simpan momen terbaikmu bersama fotografer profesional kami.</p>
    </div>

    {{-- Filter Form Glassmorphism --}}
    <form method="GET" action="{{ route('event') }}" class="clean-glass rounded-[2rem] p-5 mb-8 relative z-20 overflow-hidden">
        {{-- Ambient Orbs tipis dekoratif --}}
        <div class="absolute -top-10 -right-10 w-20 h-20 bg-blue-300/5 rounded-full blur-xl pointer-events-none"></div>
        
        <div class="flex flex-col sm:flex-row gap-4 relative z-10">

            {{-- Search Input --}}
            <div class="relative flex-1">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none">
                    <svg class="w-4 h-4 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </span>
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Cari nama acara..."
                    class="w-full pl-11 pr-4 py-3.5 clean-glass-input rounded-2xl text-xs font-black tracking-wider text-slate-700 placeholder-slate-400/70 outline-none shadow-sm shadow-slate-200/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-400 focus:bg-white/90 transition-all duration-300">
            </div>

            {{-- Kota Input --}}
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none">
                    <svg class="w-4 h-4 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </span>
                <input type="text" name="city" value="{{ request('city') }}"
                    placeholder="Kota..."
                    class="w-full sm:w-40 pl-11 pr-4 py-3.5 clean-glass-input rounded-2xl text-xs font-black uppercase tracking-wider text-slate-700 placeholder-slate-400/70 outline-none shadow-sm shadow-slate-200/50 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-400 focus:bg-white/90 transition-all duration-300">
            </div>

            {{-- Tanggal Input --}}
            <div class="relative cursor-pointer flex items-center" onclick="try { this.querySelector('input').showPicker(); } catch(e) {}">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none z-20">
                    <svg class="w-4 h-4 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </span>
                <input type="date" name="date" value="{{ request('date') }}"
                    class="w-full sm:w-48 pl-11 pr-10 py-3.5 clean-glass-input rounded-2xl text-xs font-black uppercase tracking-wider text-slate-700 outline-none shadow-sm shadow-slate-200/50 cursor-pointer [&::-webkit-calendar-picker-indicator]:opacity-0 [&::-webkit-calendar-picker-indicator]:absolute [&::-webkit-calendar-picker-indicator]:inset-0 [&::-webkit-calendar-picker-indicator]:w-full [&::-webkit-calendar-picker-indicator]:h-full [&::-webkit-calendar-picker-indicator]:cursor-pointer z-10 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-400 focus:bg-white/90 transition-all duration-300">
                <span class="absolute right-4 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none z-20 text-slate-400">
                    <svg class="w-4 h-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </span>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit"
                class="px-8 py-3.5 bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white font-black text-xs uppercase italic tracking-[0.15em] rounded-2xl transition-all hover:-translate-y-0.5 active:translate-y-0 cursor-pointer shadow-md shadow-slate-300/40 hover:shadow-lg whitespace-nowrap">
                Cari
            </button>

            @if(request()->anyFilled(['q','city','date']))
            <a href="{{ route('event') }}"
                class="px-5 py-3.5 bg-white/40 hover:bg-white/70 border border-sky-400/50 hover:border-sky-500 text-sky-600 hover:text-sky-700 rounded-2xl font-black text-xs uppercase tracking-wider transition-all hover:-translate-y-0.5 active:translate-y-0 whitespace-nowrap flex items-center justify-center gap-1.5 shadow-sm">
                <svg class="w-4 h-4 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                Reset
            </a>
            @endif

        </div>
    </form>

    {{-- Result Info --}}
    <div class="flex items-center justify-between mb-6">
        <p class="text-[10px] text-slate-400 font-black uppercase tracking-wider">
            {{ number_format($events->total()) }} acara ditemukan
        </p>
        @if(request()->anyFilled(['q','city','date']))
        <div class="flex items-center gap-2 flex-wrap">
            @if(request('q'))
            <span class="flex items-center gap-1.5 text-[9px] font-black uppercase tracking-wider text-blue-600 bg-blue-50 border border-blue-100/50 px-3 py-1.5 rounded-full">
                "{{ request('q') }}"
            </span>
            @endif
            @if(request('city'))
            <span class="flex items-center gap-1.5 text-[9px] font-black uppercase tracking-wider text-blue-600 bg-blue-50 border border-blue-100/50 px-3 py-1.5 rounded-full">
                {{ request('city') }}
            </span>
            @endif
            @if(request('date'))
            <span class="flex items-center gap-1.5 text-[9px] font-black uppercase tracking-wider text-blue-600 bg-blue-50 border border-blue-100/50 px-3 py-1.5 rounded-full">
                {{ \Carbon\Carbon::parse(request('date'))->translatedFormat('d M Y') }}
            </span>
            @endif
        </div>
        @endif
    </div>

    {{-- Grid Events --}}
    @if($events->isEmpty())
    <div class="clean-glass rounded-[2.5rem] p-12 text-center max-w-md mx-auto my-12 relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-24 h-24 bg-blue-300/5 rounded-full blur-xl pointer-events-none"></div>
        <div class="w-16 h-16 bg-sky-50 rounded-2xl flex items-center justify-center mx-auto mb-5 shadow-inner">
            <svg class="w-8 h-8 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="font-black text-slate-800 text-lg mb-1 leading-tight">Tidak ada acara ditemukan</h3>
        <p class="text-xs text-slate-400 font-semibold mb-6">Coba ubah kata kunci pencarian atau reset filter.</p>
        <a href="{{ route('event') }}" class="inline-flex px-6 py-3.5 bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white font-black text-xs uppercase italic tracking-wider rounded-2xl transition-all hover:-translate-y-0.5 active:translate-y-0 shadow-md">Reset Filter</a>
    </div>
    @else
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @foreach($events as $event)
        <a href="{{ route('event.detail', $event->id) }}"
            class="group glass-card rounded-[2rem] overflow-hidden hover:translate-y-[-6px] flex flex-col h-full">

            {{-- Cover --}}
            <div class="aspect-[4/3] overflow-hidden relative bg-slate-950/5 border-b border-slate-100/60">
                @if($event->cover_image)
                    <img src="{{ env('AWS_URL') }}/{{ $event->cover_image }}"
                         alt="{{ $event->name }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-sky-400 to-indigo-500 shadow-inner group-hover:scale-110 transition-transform duration-700 ease-out">
                        <svg class="w-12 h-12 text-white drop-shadow-md" fill="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif

                {{-- Badge foto count --}}
                <span class="absolute bottom-3 left-3 flex items-center gap-1.5 bg-slate-950/70 backdrop-blur-md text-white text-[9px] font-black uppercase tracking-wider px-3 py-1.5 rounded-full shadow-lg">
                    <svg class="w-3 h-3 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ number_format($event->photos_count) }} foto
                </span>

                {{-- Badge lokasi --}}
                <span class="absolute top-3 right-3 flex items-center gap-1.5 bg-white/95 backdrop-blur-md text-slate-700 text-[9px] font-black uppercase tracking-wider px-3 py-1.5 rounded-full shadow-md border border-slate-100/50">
                    <svg class="w-3 h-3 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ Str::limit($event->location, 14) }}
                </span>
            </div>

            {{-- Info --}}
            <div class="p-5 flex-1 flex flex-col justify-between bg-white relative z-10">
                <div>
                    <div class="flex items-center gap-1.5 text-slate-400 mb-2">
                        <svg class="w-3.5 h-3.5 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-[10px] font-black uppercase tracking-wider">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}</span>
                    </div>
                    <h3 class="font-black text-slate-800 text-sm leading-snug mb-4 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-sky-600 group-hover:to-indigo-600 transition-all duration-300 line-clamp-2">{{ $event->name }}</h3>
                </div>
                <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                    <span class="text-[10px] font-black uppercase tracking-widest text-sky-600 italic group-hover:text-indigo-600 transition-colors">Lihat Detail</span>
                    <div class="w-7 h-7 rounded-full bg-sky-50 flex items-center justify-center text-sky-600 group-hover:bg-gradient-to-r group-hover:from-sky-500 group-hover:to-indigo-600 group-hover:text-white transition-all duration-300 shadow-sm group-hover:shadow-md group-hover:shadow-blue-500/20 group-hover:scale-110">
                        <svg class="w-3.5 h-3.5 stroke-[3]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </div>
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
        <span class="w-10 h-10 flex items-center justify-center rounded-2xl bg-slate-100/80 text-slate-300 cursor-not-allowed border border-slate-200/30">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </span>
        @else
        <a href="{{ $events->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-2xl bg-white/80 border border-slate-200/80 text-slate-600 hover:border-blue-400 hover:text-blue-600 hover:scale-105 active:scale-95 transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </a>
        @endif

        {{-- Page Numbers --}}
        @foreach($events->getUrlRange(max(1, $events->currentPage()-2), min($events->lastPage(), $events->currentPage()+2)) as $page => $url)
        <a href="{{ $url }}"
            class="w-10 h-10 flex items-center justify-center rounded-2xl text-xs font-black transition-all hover:scale-105 active:scale-95
            {{ $page == $events->currentPage() ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-500/20' : 'bg-white/80 border border-slate-200/80 text-slate-600 hover:border-blue-400 hover:text-blue-600 shadow-sm' }}">
            {{ $page }}
        </a>
        @endforeach

        {{-- Next --}}
        @if($events->hasMorePages())
        <a href="{{ $events->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-2xl bg-white/80 border border-slate-200/80 text-slate-600 hover:border-blue-400 hover:text-blue-600 hover:scale-105 active:scale-95 transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>
        @else
        <span class="w-10 h-10 flex items-center justify-center rounded-2xl bg-slate-100/80 text-slate-300 cursor-not-allowed border border-slate-200/30">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </span>
        @endif
    </div>
    @endif

    @endif

</div>
@endsection
