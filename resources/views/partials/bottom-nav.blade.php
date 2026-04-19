<nav class="md:hidden fixed bottom-0 inset-x-0 bg-white/90 backdrop-blur-md border-t border-gray-100 z-50 h-[4.5rem] shadow-[0_-4px_16px_rgba(0,0,0,0.06)]">
    <div class="flex h-full items-center justify-around px-2">

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

    </div>
</nav>
