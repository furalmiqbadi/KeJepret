<nav class="hidden md:block bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                        <circle cx="12" cy="13" r="3" />
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-900 tracking-tight uppercase italic">KeJepret</span>
            </div>
            <div class="flex space-x-8">
                <a href="{{ route('home') }}"
                    class="{{ Route::is('home') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }} transition-colors">Beranda</a>
                <a href="{{ route('kejepret') }}"
                    class="{{ Route::is('jepret') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }} transition-colors">Jepret</a>
                <a href="{{ route('search') }}"
                    class="{{ Route::is('search') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }} transition-colors">Search</a>
                <a href="{{ route('koleksi') }}"
                    class="{{ Route::is('koleksi') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }} transition-colors">Koleksi</a>
                <a href="{{ route('profil') }}"
                    class="{{ Route::is('profil') ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }} transition-colors">Profil</a>
            </div>
            <div class="flex items-center">
                <button
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">Login</button>
            </div>
        </div>
    </div>
</nav>