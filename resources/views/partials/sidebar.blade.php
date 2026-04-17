<aside class="hidden md:flex flex-col w-64 h-screen bg-white border-r border-gray-200 fixed left-0 top-0 z-50">
    <!-- Logo -->
    <div class="p-6 flex items-center gap-3">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="KeJepret Logo" class="w-10 h-10 object-contain">
            <span class="text-xl font-black text-gray-900 tracking-tighter uppercase italic">KeJepret</span>
        </a>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 space-y-2 mt-4">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-2 mb-4">Menu Utama</p>
        
        <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group {{ Route::is('home') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="font-semibold text-sm">Beranda</span>
        </a>

        <a href="{{ route('kejepret') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group {{ Route::is('kejepret') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="font-semibold text-sm">KeJepret</span>
        </a>

        <a href="{{ route('search') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group {{ Route::is('search') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <span class="font-semibold text-sm">Search</span>
        </a>

        <a href="{{ route('koleksi') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group {{ Route::is('koleksi') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <span class="font-semibold text-sm">Koleksi</span>
        </a>
    </nav>

    <!-- Profile (Bottom Sidebar) -->
    <div class="p-4 border-t border-gray-100">
        <a href="{{ route('profil') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all {{ Route::is('profil') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-gray-500 hover:bg-gray-50' }}">
            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden border border-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div class="flex flex-col">
                <span class="text-xs font-bold truncate">Profil Saya</span>
                <span class="text-[10px] opacity-70">User Biasa</span>
            </div>
        </a>
    </div>
</aside>
