<div id="desktop-navbar" class="hidden md:flex fixed top-8 left-0 right-0 z-[100] items-center justify-between px-16 pointer-events-none transition-all duration-500 ease-out">
    <!-- Pill 1: Logo (Left) -->
    <div class="clean-glass h-14 rounded-2xl px-6 flex items-center pointer-events-auto hover:translate-y-[-2px] transition-all duration-300">
        @auth
            <a href="{{ Auth::user()->role === 'photographer' ? route('photographer.portfolio') : route('home') }}" class="flex items-center gap-3">
        @else
            <a href="{{ route('home') }}" class="flex items-center gap-3">
        @endauth
            <div class="w-10 h-10 overflow-hidden flex items-center justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <span class="text-xl font-black text-slate-900 tracking-tighter uppercase italic leading-none bg-clip-text text-transparent bg-gradient-to-r from-slate-950 to-slate-800">KeJepret</span>
        </a>
    </div>

    <!-- Pill 2: Navigation Links (Center) -->
    <div class="clean-glass h-14 rounded-2xl px-10 flex items-center pointer-events-auto transition-all duration-300">
        <div class="flex items-center gap-10">

            @auth
                @if(Auth::user()->role === 'photographer')
                    @php
                        $navLinks = [
                            ['route' => 'photographer.portfolio', 'label' => 'Portofolio'],
                            ['route' => 'photographer.upload',    'label' => 'Unggah Foto'],
                            ['route' => 'balance.sales',          'label' => 'Penjualan'],
                        ];
                    @endphp
                @else
                    @php
                        $navLinks = [
                            ['route' => 'home',   'label' => 'Beranda'],
                            ['route' => 'event',  'label' => 'Acara'],
                            ['route' => 'search', 'label' => 'Cari Foto'],
                        ];
                    @endphp
                @endif
            @else
                @php
                    $navLinks = [
                        ['route' => 'home',   'label' => 'Beranda'],
                        ['route' => 'event',  'label' => 'Acara'],
                        ['route' => 'search', 'label' => 'Cari Foto'],
                    ];
                @endphp
            @endauth

            @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="text-[11px] font-black uppercase tracking-[0.2em] italic transition-all duration-300 relative group {{ Route::is($link['route']) ? 'text-blue-600' : 'text-slate-500 hover:text-slate-950' }}">
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
            @php
                $profilRoute = Auth::user()->role === 'photographer'
                    ? route('photographer.profil')
                    : route('profil');
            @endphp
            <a href="{{ $profilRoute }}" class="clean-glass w-14 h-14 rounded-2xl flex items-center justify-center hover:translate-y-[-2px] transition-all duration-300 overflow-hidden p-1.5">
                <div class="w-full h-full rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white text-lg font-black italic shadow-inner overflow-hidden border border-white/10">
                    @if(Auth::user()->profile_face_url)
                        <img src="{{ Auth::user()->profile_face_url }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    @endif
                </div>
            </a>
        @else
            <a href="{{ route('login') }}" class="clean-glass h-14 px-8 rounded-2xl flex items-center text-[11px] font-black uppercase italic text-blue-600 hover:bg-gradient-to-r hover:from-blue-600 hover:to-indigo-600 hover:text-white hover:translate-y-[-2px] transition-all duration-300">
                Login
            </a>
        @endauth
    </div>
</div>

{{-- Styles and Javascript for Scroll Show/Hide --}}
<style>
    #desktop-navbar.nav-hidden {
        transform: translateY(-130%);
        opacity: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let lastScrollY = window.scrollY;
        const navbar = document.getElementById('desktop-navbar');
        if (navbar) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > lastScrollY && window.scrollY > 80) {
                    // Scroll ke bawah: sembunyikan navbar
                    navbar.classList.add('nav-hidden');
                } else {
                    // Scroll ke atas: tampilkan navbar
                    navbar.classList.remove('nav-hidden');
                }
                lastScrollY = window.scrollY;
            });
        }
    });
</script>