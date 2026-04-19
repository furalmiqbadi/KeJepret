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
                $navLinks = [
                    ['route' => 'home',   'label' => 'Beranda'],
                    ['route' => 'event',  'label' => 'Event'],
                    ['route' => 'search', 'label' => 'Search Photo'],
                    ['route' => 'profil', 'label' => 'Profil'],
                ];
            @endphp

            @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="text-[11px] font-black uppercase tracking-[0.2em] italic transition-all duration-300 relative group {{ Route::is($link['route']) ? 'text-blue-600' : 'text-slate-400 hover:text-slate-900' }}">
                    {{ $link['label'] }}
                    @if(Route::is($link['route']))
                        <span class="absolute -bottom-1 left-0 w-full h-0.5 bg-blue-600 rounded-full"></span>
                    @else
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 rounded-full group-hover:w-full transition-all duration-300"></span>
                    @endif
                </a>
            @endforeach
        </div>
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
