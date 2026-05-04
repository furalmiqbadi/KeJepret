<nav class="md:hidden fixed bottom-0 inset-x-0 bg-white/90 backdrop-blur-md border-t border-gray-100 z-50 h-[4.5rem] shadow-[0_-4px_16px_rgba(0,0,0,0.06)]">
    <div class="flex h-full items-center justify-around px-2">

        @auth
            @if(Auth::user()->role === 'photographer')

                {{-- MENU PHOTOGRAPHER --}}
                <a href="{{ route('photographer.portfolio') }}" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ Route::is('photographer.portfolio') ? 'text-blue-600' : 'text-gray-400' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-[9px] font-bold uppercase tracking-widest">Portfolio</span>
                </a>

                <a href="{{ route('photographer.upload') }}" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ Route::is('photographer.upload') ? 'text-blue-600' : 'text-gray-400' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    <span class="text-[9px] font-bold uppercase tracking-widest">Upload</span>
                </a>

                <a href="{{ route('balance.sales') }}" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ Route::is('balance.sales') ? 'text-blue-600' : 'text-gray-400' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span class="text-[9px] font-bold uppercase tracking-widest">Penjualan</span>
                </a>

                <a href="{{ route('photographer.profil') }}" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ Route::is('photographer.profil') ? 'text-blue-600' : 'text-gray-400' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-[9px] font-bold uppercase tracking-widest">Profil</span>
                </a>

            @else

                {{-- MENU RUNNER / GUEST --}}
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ Route::is('home') ? 'text-blue-600' : 'text-gray-400' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="text-[9px] font-bold uppercase tracking-widest">Beranda</span>
                </a>

                <a href="{{ route('event') }}" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ Route::is('event') ? 'text-blue-600' : 'text-gray-400' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-[9px] font-bold uppercase tracking-widest">Event</span>
                </a>

                <a href="{{ route('search') }}" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ Route::is('search') ? 'text-blue-600' : 'text-gray-400' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span class="text-[9px] font-bold uppercase tracking-widest">Cari Foto</span>
                </a>

                <a href="{{ route('profil') }}" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ Route::is('profil') ? 'text-blue-600' : 'text-gray-400' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-[9px] font-bold uppercase tracking-widest">Profil</span>
                </a>

            @endif
        @else
            {{-- GUEST --}}
            <a href="{{ route('home') }}" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ Route::is('home') ? 'text-blue-600' : 'text-gray-400' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-[9px] font-bold uppercase tracking-widest">Beranda</span>
            </a>

            <a href="{{ route('event') }}" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ Route::is('event') ? 'text-blue-600' : 'text-gray-400' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-[9px] font-bold uppercase tracking-widest">Event</span>
            </a>

            <a href="{{ route('search') }}" class="flex flex-col items-center justify-center w-full h-full gap-1 {{ Route::is('search') ? 'text-blue-600' : 'text-gray-400' }} transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span class="text-[9px] font-bold uppercase tracking-widest">Cari Foto</span>
            </a>

            <a href="{{ route('login') }}" class="flex flex-col items-center justify-center w-full h-full gap-1 text-gray-400 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                <span class="text-[9px] font-bold uppercase tracking-widest">Login</span>
            </a>
        @endauth

    </div>
</nav>