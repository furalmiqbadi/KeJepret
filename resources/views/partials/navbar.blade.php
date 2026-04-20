<<<<<<< HEAD
{{-- Centered Pill Navbar --}}
<nav class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[calc(100%-2rem)] max-w-2xl">
    <div class="bg-white rounded-2xl shadow-lg shadow-black/8 border border-gray-100 px-3 py-2 flex items-center justify-between gap-2">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex items-center gap-2 flex-shrink-0 pl-1">
            <div class="w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center shadow-sm shadow-blue-200">
                <svg class="w-4.5 h-4.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <span class="font-black text-sm">
                <span class="text-blue-600">Ke</span><span class="text-gray-900">Jepret</span>
            </span>
        </a>

        {{-- Nav Items (Desktop) --}}
        <div class="hidden md:flex items-center gap-0.5">
            <a href="{{ route('home') }}"
               class="px-3.5 py-1.5 rounded-xl text-sm font-semibold transition-all {{ Route::is('home') ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">
                Beranda
            </a>
            <a href="{{ route('kejepret') }}"
               class="px-3.5 py-1.5 rounded-xl text-sm font-semibold transition-all {{ Route::is('kejepret') ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">
                Event
            </a>
            <a href="{{ route('search') }}"
               class="px-3.5 py-1.5 rounded-xl text-sm font-semibold transition-all {{ Route::is('search') ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">
                Cari Foto
            </a>
            <a href="{{ route('koleksi') }}"
               class="px-3.5 py-1.5 rounded-xl text-sm font-semibold transition-all {{ Route::is('koleksi') ? 'bg-blue-600 text-white shadow-sm' : 'text-gray-500 hover:text-gray-800 hover:bg-gray-50' }}">
                Koleksi
            </a>
=======
<div class="hidden md:flex fixed top-8 left-0 right-0 z-[100] items-center justify-between px-16 pointer-events-none">
    <!-- Pill 1: Logo (Left) -->
    <div class="glass h-14 rounded-2xl px-6 flex items-center shadow-2xl shadow-blue-500/10 border border-white/40 pointer-events-auto hover:translate-y-[-2px] transition-all duration-300">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 overflow-hidden flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <span class="text-xl font-black text-slate-900 tracking-tighter uppercase italic leading-none">KeJepret</span>
        </a>
    </div>

    <!-- Pill 2: Navigation Links (Center) -->
    <div class="glass h-14 rounded-2xl px-10 flex items-center shadow-2xl shadow-blue-500/10 border border-white/40 pointer-events-auto">
        <div class="flex items-center gap-10">
            @php
                $links = [
                    ['route' => 'home', 'label' => 'Beranda'],
                    ['route' => 'kejepret', 'label' => 'Event'],
                    ['route' => 'search', 'label' => 'Search Photo'],
                    ['route' => 'koleksi', 'label' => 'Koleksi'],
                ];
            @endphp

            @foreach($links as $link)
                <a href="{{ route($link['route']) }}" 
                   class="text-[11px] font-black uppercase tracking-[0.2em] italic transition-all duration-300 relative group {{ Route::is($link['route']) ? 'text-blue-600' : 'text-slate-400 hover:text-slate-900' }}">
                    {{ $link['label'] }}
                    @if(Route::is($link['route']))
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-blue-600 rounded-full animate-in fade-in zoom-in duration-500"></span>
                    @else
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 rounded-full group-hover:w-full transition-all duration-300"></span>
                    @endif
                </a>
            @endforeach
>>>>>>> 836d2552c5221283ea21dcad479a465db870fe1d
        </div>

        {{-- Profile --}}
        <a href="{{ route('profil') }}"
           class="flex items-center gap-2 px-3 py-1.5 rounded-xl transition-all flex-shrink-0 {{ Route::is('profil') ? 'bg-blue-50 text-blue-600' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span class="text-sm font-semibold hidden md:block">Profil</span>
        </a>

    </div>

    <!-- Pill 3: Profile Avatar (Right) -->
    <div class="pointer-events-auto">
        @auth
            <a href="{{ route('profil') }}" class="glass w-14 h-14 rounded-2xl flex items-center justify-center shadow-2xl shadow-blue-500/10 border border-white/40 hover:translate-y-[-2px] transition-all duration-300 overflow-hidden p-1.5">
                <div class="w-full h-full rounded-xl bg-blue-600 flex items-center justify-center text-white text-lg font-black italic shadow-inner overflow-hidden border border-white/20">
                    @if(Auth::user()->profile_face_url)
                        <img src="{{ Auth::user()->profile_face_url }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    @endif
                </div>
            </a>
        @else
            <a href="{{ route('login') }}" class="glass h-14 px-8 rounded-2xl flex items-center text-[11px] font-black uppercase italic shadow-2xl shadow-blue-500/10 border border-white/40 text-blue-600 hover:bg-blue-600 hover:text-white transition-all duration-300">
                Login
            </a>
        @endauth
    </div>
</div>

<style>
    .glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(40px);
        -webkit-backdrop-filter: blur(40px);
    }
</style>