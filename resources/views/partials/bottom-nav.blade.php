<nav class="md:hidden fixed bottom-0 inset-x-0 bg-white/80 backdrop-blur-md border-t border-gray-100 z-50 h-[4.5rem] shadow-[0_-5px_20px_rgba(0,0,0,0.05)]">
    <div class="flex h-full items-center justify-around px-2">
        <a href="{{ route('home') }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ Route::is('home') ? 'text-blue-600' : 'text-gray-400 hover:text-gray-600' }} transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-[9px] font-bold uppercase tracking-widest">Home</span>
        </a>
        <a href="{{ route('kejepret') }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ Route::is('kejepret') ? 'text-blue-600' : 'text-gray-400 hover:text-gray-600' }} transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-[9px] font-bold uppercase tracking-widest">KeJepret</span>
        </a>
        <a href="{{ route('search') }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ Route::is('search') ? 'text-blue-600' : 'text-gray-400 hover:text-gray-600' }} transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <span class="text-[9px] font-bold uppercase tracking-widest">Search</span>
        </a>
        <a href="{{ route('koleksi') }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ Route::is('koleksi') ? 'text-blue-600' : 'text-gray-400 hover:text-gray-600' }} transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="text-[9px] font-bold uppercase tracking-widest">Koleksi</span>
        </a>
    </div>
</nav>
