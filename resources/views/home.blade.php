@extends('layouts.app')
@section('title', 'Beranda')
@section('content')

@php
$steps = [
    ['num'=>'01','title'=>'Cari Event-mu','desc'=>'Ketik nama event marathon atau kota yang kamu ikuti. Filter berdasarkan kota atau tanggal.','icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
    ['num'=>'02','title'=>'Pilih & Beli Foto','desc'=>'Temukan fotomu lewat nomor BIB atau km marker. Bayar mudah, harga mulai Rp 20.000.','icon'=>'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
    ['num'=>'03','title'=>'Download Selamanya','desc'=>'Foto resolusi tinggi langsung tersimpan di koleksimu. Download kapan saja, tanpa batas.','icon'=>'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4'],
];
$testimonials = [
    ['name'=>'Andi Wijaya',   'event'=>'Jakarta Marathon 2025', 'avatar'=>'AW', 'color'=>'bg-blue-100 text-blue-700',   'quote'=>'Langsung ketemu foto saya di finish line. Kualitasnya sangat bagus dan harganya sangat terjangkau.'],
    ['name'=>'Sari Dewi',     'event'=>'Bali Fun Run 2025',     'avatar'=>'SD', 'color'=>'bg-orange-100 text-orange-700','quote'=>'Di KeJepret langsung ketemu dengan nomor BIB. Prosesnya cepat banget. Recommended!'],
    ['name'=>'Budi Santoso',  'event'=>'Bandung Trail Run 2025','avatar'=>'BS', 'color'=>'bg-green-100 text-green-700',  'quote'=>'Foto resolusi tinggi, proses download cepat. Akan terus pakai KeJepret di setiap event!'],
];
@endphp

{{-- ===== HERO ===== --}}
<section class="max-w-5xl mx-auto px-4 sm:px-6 pt-10 pb-16 text-center">

    <div class="inline-flex items-center gap-2 bg-white rounded-full px-4 py-2 shadow-sm border border-gray-100 mb-8 hover:-translate-y-0.5 transition-transform">
        <span class="flex gap-1">
            <span class="w-2 h-2 rounded-full bg-orange-400"></span>
            <span class="w-2 h-2 rounded-full bg-blue-500"></span>
            <span class="w-2 h-2 rounded-full bg-green-400"></span>
        </span>
        <span class="text-xs font-semibold text-gray-600">{{ number_format($totalPhotos) }}+ foto tersedia di KeJepret</span>
    </div>

    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-black leading-[1.1] tracking-tight text-slate-800 mb-6 drop-shadow-sm">
        Temukan Foto Larimu<br>
        <span class="bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-600 bg-clip-text text-transparent">dari Setiap Event</span>
    </h1>
    <p class="text-gray-500 text-base sm:text-lg max-w-xl mx-auto mb-10 leading-relaxed">
        Cari, temukan, dan miliki foto terbaikmu dari ratusan event marathon di seluruh Indonesia. Resolusi tinggi, harga terjangkau.
    </p>

    <form action="{{ route('search') }}" method="GET" class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto mb-16 relative z-10">
        <input type="text" name="q" placeholder="Cari nama event atau kota..."
            class="flex-1 px-5 py-3.5 clean-glass-input rounded-2xl text-sm font-bold placeholder-slate-500 focus:outline-none transition-all shadow-sm shadow-slate-200/50">
        <button type="submit" class="flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold text-sm px-7 py-3.5 rounded-2xl transition-all shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/35 whitespace-nowrap hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
            Cari Sekarang
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>
    </form>

    {{-- Feature Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-16 relative z-10">

        <div class="glass-card rounded-2xl p-5 text-left">
            <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500 block mb-2">FOTO EVENT</span>
            <h3 class="font-black text-gray-900 text-base mb-1">Ribuan Foto<br>Siap Download</h3>
            <p class="text-gray-500 text-xs mb-4">Temukan momen terbaikmu berdasarkan nomor BIB atau kilometre.</p>
            <div class="flex gap-1.5 mb-4">
                <span class="px-2.5 py-1 bg-white/20 text-slate-800 text-[10px] font-bold rounded-lg backdrop-blur-md border border-white/20">Road Run</span>
                <span class="px-2.5 py-1 bg-white/20 text-slate-800 text-[10px] font-bold rounded-lg backdrop-blur-md border border-white/20">On Course</span>
                <span class="px-2.5 py-1 bg-white/20 text-slate-800 text-[10px] font-bold rounded-lg backdrop-blur-md border border-white/20">Finish</span>
            </div>
            <div class="h-20 rounded-xl overflow-hidden bg-slate-950/20 flex items-center justify-center border border-white/20">
                @if($events->first() && $events->first()->cover_image)
                    <img src="{{ env('AWS_URL') }}/{{ $events->first()->cover_image }}" alt="Cover" class="w-full h-full object-cover">
                @else
                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                @endif
            </div>
        </div>

        <div class="glass-btn-blue rounded-2xl p-5 text-left text-white shadow-lg">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-7 h-7 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-blue-100">KEPUASAN</span>
            </div>
            <div class="text-4xl font-black mb-0.5">4.9<span class="text-xl text-blue-200">/5</span></div>
            <p class="text-blue-100 text-xs mb-5">Rating dari pengguna setia KeJepret</p>
            <div class="border-t border-white/20 pt-4">
                <p class="text-[10px] font-bold uppercase tracking-widest text-blue-100 mb-1">EVENT TERSEDIA</p>
                <div class="text-3xl font-black">{{ $totalEvents }}+</div>
                <p class="text-blue-100 text-xs">Event aktif di seluruh Indonesia</p>
            </div>
        </div>

        <div class="rounded-2xl p-5 text-left text-white shadow-lg relative overflow-hidden bg-slate-900">
            @if($events->count() > 1 && $events[1]->cover_image)
            <div class="absolute inset-0 opacity-30 mix-blend-luminosity">
                <img src="{{ env('AWS_URL') }}/{{ $events[1]->cover_image }}" alt="" class="w-full h-full object-cover">
            </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/30 to-slate-900/90 pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-1.5 mb-3">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-300">LIVE ACARA</span>
                </div>
                <div class="text-3xl font-black mb-1 text-white">{{ number_format($totalPhotos) }}+</div>
                <p class="text-slate-200 text-[10px] font-bold tracking-widest uppercase mb-2">FOTO TERSEDIA</p>
                <p class="text-slate-400 text-xs mb-6 font-medium leading-relaxed">Diperbarui seketika, temukan fotomu langsung setelah finish.</p>
                <a href="{{ route('event') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-900 bg-white px-5 py-2.5 rounded-xl hover:bg-slate-100 transition-all hover:scale-105">
                    Lihat Acara
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

    </div>

    {{-- Stats Row --}}
    <div class="clean-glass bg-white/40 backdrop-blur-xl border border-white/60 rounded-[2.5rem] p-8 my-8 relative z-10 shadow-sm">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 divide-x divide-slate-200/40">
            <div class="text-center hover:scale-105 transition-transform duration-300">
                <div class="text-3xl sm:text-4xl font-black text-slate-800 mb-1">{{ number_format($totalPhotos) }}+</div>
                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-500">FOTO TERSEDIA</div>
            </div>
            <div class="text-center hover:scale-105 transition-transform duration-300">
                <div class="text-3xl sm:text-4xl font-black text-slate-800 mb-1">{{ $totalEvents }}+</div>
                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-500">ACARA AKTIF</div>
            </div>
            <div class="text-center hover:scale-105 transition-transform duration-300">
                <div class="text-3xl sm:text-4xl font-black text-slate-800 mb-1">15k+</div>
                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-500">PELARI TERDAFTAR</div>
            </div>
            <div class="text-center hover:scale-105 transition-transform duration-300">
                <div class="text-3xl sm:text-4xl font-black text-slate-800 mb-1">4.9<span class="text-xl text-slate-400">/5</span></div>
                <div class="text-[10px] font-bold uppercase tracking-widest text-slate-500">RATING PENGGUNA</div>
            </div>
        </div>
    </div>

</section>

{{-- ===== CARA KERJA ===== --}}
<section class="py-16 bg-transparent relative z-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12">
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-2">CARA KERJA</p>
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900">Mudah dalam 3 Langkah</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            @foreach($steps as $step)
            <div class="clean-glass rounded-[2rem] p-8 relative overflow-hidden group hover:-translate-y-1 hover:shadow-xl transition-all duration-300">
                <div class="absolute -top-6 -right-6 text-8xl font-black bg-gradient-to-br from-sky-500/10 to-indigo-600/5 bg-clip-text text-transparent group-hover:scale-110 transition-transform duration-500 select-none">{{ $step['num'] }}</div>
                <div class="w-10 h-10 bg-blue-600/10 text-blue-600 border border-blue-500/10 rounded-xl flex items-center justify-center mb-4 relative z-10">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-black text-gray-900 mb-2 relative z-10">{{ $step['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed relative z-10">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== EVENT TERBARU ===== --}}
<section class="py-16 relative z-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="flex items-end justify-between mb-8">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">EVENT LARI</p>
                <h2 class="text-2xl sm:text-3xl font-black text-gray-900">Event Terbaru</h2>
            </div>
            <a href="{{ route('event') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1 transition-colors">
                Lihat semua
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        @if($events->isEmpty())
        <div class="text-center py-16 text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <p class="font-semibold text-sm">Belum ada event tersedia</p>
        </div>
        @else
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($events as $event)
            <a href="{{ route('event') }}" class="group glass-card rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="aspect-[4/3] overflow-hidden relative bg-slate-950/20">
                    @if($event->cover_image)
                        <img src="{{ env('AWS_URL') }}/{{ $event->cover_image }}"
                             alt="{{ $event->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-slate-300 group-hover:scale-110 transition-transform duration-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-slate-900/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    <span class="absolute top-3 right-3 flex items-center gap-1 bg-white/95 backdrop-blur-md shadow-sm text-slate-700 text-[10px] font-black px-3 py-1.5 rounded-full z-10 group-hover:-translate-y-0.5 transition-transform duration-300">
                        <svg class="w-3.5 h-3.5 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ Str::limit($event->location, 12) }}
                    </span>
                </div>
                <div class="p-4">
                    <div class="flex items-center gap-1.5 text-gray-400 mb-1">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-[11px] font-semibold">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}</span>
                    </div>
                    <h3 class="font-black text-gray-900 text-sm leading-tight">{{ $event->name }}</h3>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- ===== KENAPA KEJEPRET ===== --}}
<section class="bg-white py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-3">KENAPA KEJEPRET?</p>
                <h2 class="text-3xl sm:text-4xl font-black text-gray-900 leading-tight mb-4">
                    Platform Foto Lari<br><span class="text-blue-600">Terpercaya #1</span>
                </h2>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">
                    Kami bekerja sama dengan fotografer terbaik di setiap event untuk memastikan momen berhargamu terabadikan dengan sempurna.
                </p>
                <ul class="space-y-3 mb-8">
                    @foreach(['Foto resolusi tinggi ready to print','Harga terjangkau mulai Rp 20.000','Unduh langsung tanpa batas waktu','Fotografer profesional di setiap event'] as $item)
                    <li class="flex items-center gap-3">
                        <div class="w-5 h-5 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-sm text-gray-700 font-medium">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('search') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm px-7 py-3.5 rounded-xl transition-colors shadow-md shadow-blue-200">
                    Jelajahi Foto
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-3">
                @forelse($randomPhotos as $photo)
                <div class="rounded-2xl overflow-hidden aspect-square bg-slate-100 group">
                    @if($photo->watermark_path || $photo->r2_path)
                        <img src="{{ env('AWS_URL') }}/{{ $photo->watermark_path ?? $photo->r2_path }}" alt="Random Photo" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 ease-out">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                </div>
                @empty
                @for($i = 0; $i < 4; $i++)
                <div class="rounded-2xl overflow-hidden aspect-square bg-slate-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                @endfor
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ===== TESTIMONI ===== --}}
<section class="py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-2">TESTIMONI</p>
            <h2 class="text-3xl font-black text-gray-900">Kata Mereka</h2>
        </div>
        <div class="grid sm:grid-cols-3 gap-5">
            @foreach($testimonials as $t)
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lg hover:shadow-blue-500/10">
                <div class="flex gap-0.5 mb-4">
                    @for($i = 0; $i < 5; $i++)
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-5 italic">"{{ $t['quote'] }}"</p>
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full {{ $t['color'] }} flex items-center justify-center text-xs font-black flex-shrink-0">{{ $t['avatar'] }}</div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">{{ $t['name'] }}</p>
                        <p class="text-xs text-gray-400">{{ $t['event'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== BERGABUNG ===== --}}
<section class="bg-white py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-10">
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-2">BERGABUNG</p>
            <h2 class="text-3xl font-black text-gray-900">Untuk Semua Orang</h2>
        </div>
        <div class="grid sm:grid-cols-3 gap-5">

            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lg hover:shadow-blue-500/10">
                <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="font-black text-gray-900 mb-2">Event Organizer</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">Dokumentasikan event lari Anda dengan fotografer profesional kami. Bagikan kenangan kepada peserta.</p>
                <a href="{{ route('event.propose') }}" class="text-sm font-bold text-blue-600 flex items-center gap-1 hover:underline">
                    Ajukan Event
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="bg-blue-600 rounded-2xl p-6 shadow-lg shadow-blue-200 relative overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-blue-600/30">
                <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="font-black text-white mb-2">Jadi Fotografer</h3>
                <p class="text-white/75 text-sm leading-relaxed mb-5">Bergabunglah sebagai mitra fotografer dan dapatkan penghasilan dari setiap foto yang terjual.</p>
                <a href="{{ route('register.photographer') }}" class="inline-flex items-center gap-1.5 bg-white text-blue-600 font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-blue-50 transition-colors shadow">
                    Daftar Sekarang
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-lg hover:shadow-blue-500/10">
                <div class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-black text-gray-900 mb-2">Butuh Bantuan?</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">Punya pertanyaan tentang foto atau event? Tim support kami siap membantu kapan saja.</p>
                <a href="mailto:support@kejepret.id" class="text-sm font-bold text-blue-600 flex items-center gap-1 hover:underline">
                    Hubungi Kami
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- ===== FOOTER CTA ===== --}}
<section class="bg-gray-900 pt-16 pb-8 text-center rounded-b-[2.5rem] sm:rounded-none">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">
        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">MULAI SEKARANG</p>
        <h2 class="text-4xl sm:text-5xl font-black text-white leading-tight mb-4">
            Temukan Fotomu<br>Sekarang Juga
        </h2>
        <p class="text-gray-400 text-base mb-10">Ribuan foto dari ratusan event lari menunggu kamu. Gratis untuk dicari.</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('search') }}" class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white font-bold px-8 py-4 rounded-2xl transition-all shadow-xl shadow-blue-900/40">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari Fotomu
            </a>
            <a href="{{ route('event') }}" class="flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 text-white font-bold px-8 py-4 rounded-2xl transition-all border border-white/20">
                Lihat Event
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
    <div class="max-w-5xl mx-auto px-4 mt-12 pt-6 border-t border-gray-800">
        <p class="text-gray-500 text-sm">© 2026 KeJepret. Platform foto lari terpercaya di Indonesia.</p>
    </div>
</section>

@endsection