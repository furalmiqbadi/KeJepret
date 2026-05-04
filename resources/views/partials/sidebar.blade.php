<aside class="hidden md:flex flex-col w-64 h-screen bg-white border-r border-gray-200 fixed left-0 top-0 z-50">

    <!-- Logo -->
    <div class="p-6 flex items-center gap-3">
        <div class="w-10 h-10 overflow-hidden flex items-center justify-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full object-contain">
        </div>
        <span class="text-xl font-black text-gray-900 tracking-tighter uppercase italic">KeJepret</span>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 space-y-2 mt-4">
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-2 mb-4">Menu Utama</p>

        @php
            $sideLinks = [
                [
                    'route' => 'home',
                    'label' => 'Beranda',
                    'icon'  => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                ],
                [
                    'route' => 'event',
                    'label' => 'Event',
                    'icon'  => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                ],
                [
                    'route' => 'search',
                    'label' => 'Search Photo',
                    'icon'  => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z',
                ],
                [
                    'route' => 'profil',
                    'label' => 'Profil',
                    'icon'  => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                ],
            ];
        @endphp

        @foreach($sideLinks as $link)
            <a href="{{ route($link['route']) }}"
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all group {{ Route::is($link['route']) ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}"/>
                </svg>
                <span class="font-semibold text-sm">{{ $link['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <!-- Profile Bottom -->
    <div class="p-4 border-t border-gray-100">
        @auth
            <a href="{{ route('profil') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-xl transition-all {{ Route::is('profil') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-gray-500 hover:bg-gray-50' }}">
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden border border-gray-300 flex-shrink-0">
                    @if(Auth::user()->profile_face_url)
                        <img src="{{ Auth::user()->profile_face_url }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @endif
                </div>
                <div class="flex flex-col">
                    <span class="text-xs font-bold truncate">{{ Auth::user()->name ?? 'Profil Saya' }}</span>
                    <span class="text-[10px] opacity-70 capitalize">{{ Auth::user()->role ?? 'runner' }}</span>
                </div>
            </a>
        @else
            <a href="{{ route('login') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-xl text-gray-500 hover:bg-gray-50 transition-all">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                <span class="font-semibold text-sm">Login</span>
            </a>
        @endauth
    </div>

</aside>
