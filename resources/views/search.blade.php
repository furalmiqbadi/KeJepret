@extends('layouts.app')
@section('title', 'Cari Foto')
@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 pt-2 pb-8 sm:py-8 relative">
    {{-- Decorative Ambient Orbs --}}
    <div class="absolute top-10 -left-40 w-96 h-96 bg-sky-300/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 -right-40 w-[28rem] h-[28rem] bg-indigo-300/10 rounded-full blur-3xl pointer-events-none"></div>

    {{-- Header --}}
    <div class="mb-8 relative z-10">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">PENCARIAN</p>
        <h1 class="text-3xl sm:text-4xl font-black tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900">Cari Foto & Acara</h1>
        <p class="text-gray-500 text-sm mt-1">Pilih acara larimu, lalu cari fotomu di dalamnya.</p>
    </div>

    {{-- Search Form dengan Autocomplete Event --}}
    <form method="GET" action="{{ route('search') }}" class="mb-6 relative z-10" id="searchForm">

        {{-- Event Autocomplete Input --}}
        <div class="mb-4">
            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-blue-600 mb-2">
                PILIH ACARA <span class="text-slate-400 normal-case tracking-normal font-semibold">(opsional)</span>
            </label>
            <div class="relative" id="eventAutocompleteWrapper">
                {{-- Hidden input untuk value sesungguhnya --}}
                <input type="hidden" name="event_id" id="eventIdInput" value="{{ request('event_id') }}">

                {{-- Text input yang user ketik --}}
                <span class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none z-10">
                    <svg class="w-4 h-4 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </span>
                <input type="text" id="eventTextInput"
                    placeholder="Ketik nama acara... atau biarkan kosong untuk semua"
                    autocomplete="off"
                    value="{{ request('event_id') ? $allEvents->firstWhere('id', request('event_id'))?->name ?? '' : '' }}"
                    class="w-full pl-11 pr-10 py-3.5 clean-glass-input rounded-2xl text-sm font-bold placeholder-slate-400 focus:outline-none transition-all shadow-sm shadow-slate-200/50">

                {{-- Clear button --}}
                <button type="button" id="clearEventBtn"
                    class="{{ request('event_id') ? '' : 'hidden' }} absolute right-3 top-1/2 -translate-y-1/2 w-6 h-6 flex items-center justify-center rounded-full bg-slate-100 hover:bg-slate-200 text-slate-400 hover:text-slate-600 transition-all z-10">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                {{-- Suggestions Dropdown --}}
                <div id="eventSuggestions"
                    class="hidden absolute top-full left-0 right-0 mt-2 bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-100/80 overflow-hidden z-50 max-h-64 overflow-y-auto">

                    {{-- Option: Semua Acara --}}
                    <button type="button"
                        class="event-suggestion-item w-full flex items-center gap-3 px-4 py-3 hover:bg-sky-50 transition-colors text-left border-b border-slate-100"
                        data-id="" data-name="Semua Acara">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-sky-100 to-indigo-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-800">Semua Acara</p>
                            <p class="text-[10px] text-slate-400 font-semibold">Tampilkan semua event</p>
                        </div>
                    </button>

                    {{-- Daftar Event --}}
                    @foreach($allEvents as $ev)
                    <button type="button"
                        class="event-suggestion-item w-full flex items-center gap-3 px-4 py-3 hover:bg-sky-50 transition-colors text-left border-b border-slate-100/50 last:border-0"
                        data-id="{{ $ev->id }}" data-name="{{ $ev->name }}">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-black text-slate-800 truncate">{{ $ev->name }}</p>
                            <p class="text-[10px] text-slate-400 font-semibold">{{ \Carbon\Carbon::parse($ev->event_date)->translatedFormat('d M Y') }} · {{ Str::limit($ev->location, 25) }}</p>
                        </div>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full py-3.5 bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white font-black text-xs uppercase italic tracking-[0.15em] rounded-2xl transition-all hover:-translate-y-0.5 active:translate-y-0 shadow-md shadow-slate-300/40 hover:shadow-lg">
            Cari Foto
        </button>
    </form>

    {{-- Script Autocomplete --}}
    <script>
    (function () {
        const textInput   = document.getElementById('eventTextInput');
        const idInput     = document.getElementById('eventIdInput');
        const suggestions = document.getElementById('eventSuggestions');
        const clearBtn    = document.getElementById('clearEventBtn');
        const items       = document.querySelectorAll('.event-suggestion-item');

        function showSuggestions() { suggestions.classList.remove('hidden'); }
        function hideSuggestions() { setTimeout(() => suggestions.classList.add('hidden'), 150); }

        function filterItems(q) {
            const lq = q.toLowerCase().trim();
            items.forEach(item => {
                const name = item.dataset.name.toLowerCase();
                // Selalu tampilkan "Semua Acara"
                item.style.display = (item.dataset.id === '' || name.includes(lq)) ? '' : 'none';
            });
        }

        textInput.addEventListener('focus', () => { filterItems(textInput.value); showSuggestions(); });
        textInput.addEventListener('blur', hideSuggestions);
        textInput.addEventListener('input', () => { filterItems(textInput.value); showSuggestions(); });

        items.forEach(item => {
            item.addEventListener('mousedown', () => {
                const id   = item.dataset.id;
                const name = item.dataset.name;
                idInput.value   = id;
                textInput.value = id === '' ? '' : name;
                clearBtn.classList.toggle('hidden', id === '');
                suggestions.classList.add('hidden');
                // Langsung submit jika pilih event
                if (id !== '') document.getElementById('searchForm').submit();
            });
        });

        clearBtn.addEventListener('click', () => {
            idInput.value   = '';
            textInput.value = '';
            clearBtn.classList.add('hidden');
            textInput.focus();
        });

        // Klik di luar tutup dropdown
        document.addEventListener('click', e => {
            if (!document.getElementById('eventAutocompleteWrapper').contains(e.target)) {
                suggestions.classList.add('hidden');
            }
        });
    })();
    </script>


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
