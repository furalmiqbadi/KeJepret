<nav class="md:hidden fixed bottom-6 left-6 right-6 z-[100] animate-in slide-in-from-bottom-8 duration-700">
    <div class="glass rounded-[2rem] px-4 py-2 flex items-center justify-around shadow-2xl shadow-blue-500/10 border border-white/40">
        @php
            $links = [
                ['route' => 'home', 'label' => 'Home', 'icon' => 'home'],
                ['route' => 'kejepret', 'label' => 'Jepret', 'icon' => 'camera_enhance'],
                ['route' => 'search', 'label' => 'Search', 'icon' => 'search'],
                ['route' => 'koleksi', 'label' => 'Koleksi', 'icon' => 'collections'],
                ['route' => 'profil', 'label' => 'Profil', 'icon' => 'person'],
            ];
        @endphp

        @foreach($links as $link)
            <a href="{{ route($link['route']) }}" 
               class="flex flex-col items-center justify-center p-2 rounded-2xl transition-all duration-300 relative {{ Route::is($link['route']) ? 'text-blue-600' : 'text-slate-400 hover:text-slate-900' }}">
                <span class="material-symbols-outlined text-[24px] {{ Route::is($link['route']) ? 'fill-1' : '' }}">
                    {{ $link['icon'] }}
                </span>
                <span class="text-[9px] font-black uppercase tracking-tighter mt-1">{{ $link['label'] }}</span>
                
                @if(Route::is($link['route']))
                    <span class="absolute -top-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-blue-600 rounded-full"></span>
                @endif
            </a>
        @endforeach
    </div>
</nav>

<style>
    .glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
    .fill-1 { font-variation-settings: 'FILL' 1; }
</style>