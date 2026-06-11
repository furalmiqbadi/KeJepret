<div id="desktop-navbar" class="hidden md:flex fixed top-6 left-1/2 -translate-x-1/2 z-[100] w-[95%] max-w-5xl transition-all duration-500 ease-out">
    <div class="w-full bg-white/70 backdrop-blur-3xl border border-white/60 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] rounded-[2rem] px-5 py-3 flex items-center justify-between pointer-events-auto hover:bg-white/85 hover:shadow-[0_15px_50px_-10px_rgba(37,99,235,0.15)] transition-all duration-500">
        
        <!-- Left: Logo -->
        <div class="flex items-center">
            @auth
                <a href="{{ Auth::user()->role === 'photographer' ? route('photographer.portfolio') : route('home') }}" class="flex items-center gap-3 group">
            @else
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            @endauth
                <div class="w-11 h-11 bg-white rounded-[1rem] shadow-sm border border-slate-100 overflow-hidden flex items-center justify-center p-2 group-hover:scale-105 transition-transform duration-300">
                    <img src="/images/logo.png" alt="Logo" class="w-full h-full object-contain">
                </div>
                <span class="text-xl font-black text-slate-800 tracking-tighter uppercase italic bg-clip-text text-transparent bg-gradient-to-br from-slate-900 to-slate-700">KeJepret</span>
            </a>
        </div>

        <!-- Center: Navigation Links -->
        <div class="flex items-center gap-8">

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
                            ['route' => 'runner.search.history', 'label' => 'Riwayat Cari'],
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
                   class="text-[11px] font-black uppercase tracking-[0.15em] transition-all duration-300 relative py-2 {{ Route::is($link['route']) ? 'text-blue-600' : 'text-slate-500 hover:text-slate-900' }}">
                     {{ $link['label'] }}
                    @if(Route::is($link['route']))
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-4 h-1 bg-blue-600 rounded-t-full"></span>
                    @else
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-1 bg-blue-600/50 rounded-t-full transition-all duration-300 opacity-0"></span>
                    @endif
                </a>
            @endforeach

        </div>

        <!-- Right: Notifications / Profile / Login -->
        <div class="flex items-center">
            @auth
                @if(Auth::user()->role === 'photographer')
                    @include('partials.photographer-notification-widget', ['variant' => 'desktop'])
                @endif
                @php
                    $profilRoute = Auth::user()->role === 'photographer'
                        ? route('photographer.profil')
                        : route('profil');
                @endphp
                <a href="{{ $profilRoute }}" class="w-12 h-12 rounded-[1.1rem] flex items-center justify-center hover:scale-105 hover:rotate-3 transition-all duration-300 overflow-hidden shadow-sm border-2 border-white bg-gradient-to-tr from-blue-600 to-indigo-600 text-white text-sm font-black italic {{ Auth::user()->role === 'photographer' ? 'ml-3' : '' }}">
                    @if(Auth::user()->profile_face_url)
                        <img src="{{ Auth::user()->profile_face_url }}" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    @endif
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-7 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                    Masuk
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            @endauth
        </div>

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