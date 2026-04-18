<aside id="sidebar" class="hidden md:flex flex-col w-64 h-screen bg-white border-r border-gray-200 fixed left-0 top-0 z-50 overflow-hidden">
    <!-- Logo & Toggle (Zero-Movement Structure) -->
    <div class="flex flex-col gap-2 pt-6 pb-2 overflow-hidden">
        <!-- Logo Zone -->
        <a href="{{ route('home') }}" class="flex items-center shrink-0 group">
            <div class="w-20 h-12 flex items-center justify-center shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="KeJepret Logo" class="w-12 h-12 object-contain transform group-hover:scale-105 transition-transform duration-500">
            </div>
            <span class="text-2xl font-black text-gray-900 tracking-tighter uppercase italic logo-text">KeJepret</span>
        </a>
        
        <!-- Toggle Hub -->
        <div class="flex items-center shrink-0">
            <div class="w-20 flex items-center justify-center shrink-0">
                <button onclick="toggleSidebar()" class="p-2 bg-gray-50 hover:bg-gray-100 rounded-xl text-gray-400 hover:text-blue-600 transition-all border border-gray-100 shadow-sm flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl" id="toggle-icon">menu_open</span>
                </button>
            </div>
            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 sidebar-label">Navigation Hub</span>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 space-y-2 mt-0 overflow-hidden">
        <!-- Divider Line (Always Visible) -->
        <div class="py-2 transition-all duration-300">
            <div class="border-t border-gray-200 mx-6"></div>
        </div>
        
        <!-- Home -->
        <a href="{{ route('home') }}" class="sidebar-item relative flex items-center group {{ Route::is('home') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-900' }}">
            <div class="w-20 h-12 flex items-center justify-center shrink-0">
                <div class="p-3 rounded-xl transition-all {{ Route::is('home') ? 'bg-blue-50' : 'group-hover:bg-gray-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
            </div>
            <span class="font-bold text-sm sidebar-text">Beranda</span>
            <span class="sidebar-tooltip">Beranda Utama</span>
        </a>

        <!-- KeJepret -->
        <a href="{{ route('kejepret') }}" class="sidebar-item relative flex items-center group {{ Route::is('kejepret') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-900' }}">
            <div class="w-20 h-12 flex items-center justify-center shrink-0">
                <div class="p-3 rounded-xl transition-all {{ Route::is('kejepret') ? 'bg-blue-50' : 'group-hover:bg-gray-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
            <span class="font-bold text-sm sidebar-text">KeJepret</span>
            <span class="sidebar-tooltip">Mulai KeJepret</span>
        </a>

        <!-- Search -->
        <a href="{{ route('search') }}" class="sidebar-item relative flex items-center group {{ Route::is('search') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-900' }}">
            <div class="w-20 h-12 flex items-center justify-center shrink-0">
                <div class="p-3 rounded-xl transition-all {{ Route::is('search') ? 'bg-blue-50' : 'group-hover:bg-gray-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <span class="font-bold text-sm sidebar-text">Search</span>
            <span class="sidebar-tooltip">Cari Foto AI</span>
        </a>

        <!-- Koleksi -->
        <a href="{{ route('koleksi') }}" class="sidebar-item relative flex items-center group {{ Route::is('koleksi') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-900' }}">
            <div class="w-20 h-12 flex items-center justify-center shrink-0">
                <div class="p-3 rounded-xl transition-all {{ Route::is('koleksi') ? 'bg-blue-50' : 'group-hover:bg-gray-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <span class="font-bold text-sm sidebar-text">Koleksi</span>
            <span class="sidebar-tooltip">Koleksi Album</span>
        </a>
    </nav>

    <!-- Profile (Bottom Sidebar) -->
    <div class="py-4 border-t border-gray-100 overflow-hidden">
        <a href="{{ route('profil') }}" class="sidebar-item relative flex items-center group {{ Route::is('profil') ? 'text-blue-600' : 'text-gray-500 hover:text-gray-900' }}">
            <div class="w-20 h-12 flex items-center justify-center shrink-0">
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center shrink-0 overflow-hidden border border-gray-300 transition-all {{ Route::is('profil') ? 'ring-2 ring-blue-600 ring-offset-2' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <div class="flex flex-col sidebar-text">
                <span class="text-xs font-black truncate">Profil Saya</span>
                <span class="text-[10px] opacity-70">User Biasa</span>
            </div>
            <span class="sidebar-tooltip">Halaman Profil</span>
        </a>
    </div>
</aside>