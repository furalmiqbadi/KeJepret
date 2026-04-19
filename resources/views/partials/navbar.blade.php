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
</nav>