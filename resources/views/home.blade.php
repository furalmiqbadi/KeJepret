@extends('layouts.app')
@section('title', 'Beranda')
@section('content')

@php
$steps = [
    ['num'=>'01','title'=>'Cari Event-mu','desc'=>'Ketik nama event marathon atau kota yang kamu ikuti. Filter berdasarkan kota atau tanggal.','icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
    ['num'=>'02','title'=>'Pilih & Beli Foto','desc'=>'Temukan fotomu lewat pengenalan wajah . Bayar mudah, harga mulai Rp 20.000.','icon'=>'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
    ['num'=>'03','title'=>'Unduh & Simpan Selamanya','desc'=>'Foto resolusi tinggi langsung tersimpan di koleksimu. Unduh kapan saja, tanpa batas.','icon'=>'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4'],
];
$testimonials = [
    ['name'=>'Andi Wijaya',   'event'=>'Jakarta Marathon 2025', 'avatar'=>'AW', 'color'=>'bg-blue-100 text-blue-700',   'quote'=>'Langsung ketemu foto saya di finish line. Kualitasnya sangat bagus dan harganya sangat terjangkau.'],
    ['name'=>'Sari Dewi',     'event'=>'Bali Fun Run 2025',     'avatar'=>'SD', 'color'=>'bg-orange-100 text-orange-700','quote'=>'Di KeJepret langsung ketemu dengan nomor BIB. Prosesnya cepat banget. Recommended!'],
    ['name'=>'Budi Santoso',  'event'=>'Bandung Trail Run 2025','avatar'=>'BS', 'color'=>'bg-green-100 text-green-700',  'quote'=>'Foto resolusi tinggi, proses download cepat. Akan terus pakai KeJepret di setiap event!'],
];
@endphp

{{-- ===== HERO ===== --}}
<section class="max-w-6xl mx-auto px-4 sm:px-6 pt-16 pb-24 text-center relative overflow-hidden">
    
    {{-- Decorative Background Elements --}}
    <div class="absolute inset-0 pointer-events-none -z-10 flex justify-center">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[600px] bg-blue-400/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 w-full h-[300px] bg-gradient-to-t from-blue-50/80 to-transparent"></div>
        
        {{-- Vertical Light Bars Effect --}}
        <div class="absolute bottom-0 left-1/4 w-32 h-64 bg-gradient-to-t from-sky-400/10 to-transparent blur-2xl"></div>
        <div class="absolute bottom-0 right-1/4 w-32 h-64 bg-gradient-to-t from-indigo-400/10 to-transparent blur-2xl"></div>
    </div>

    {{-- 1. Badge --}}
    <div class="inline-flex items-center gap-2 bg-white rounded-full px-4 py-2 shadow-[0_2px_10px_rgba(0,0,0,0.05)] border border-slate-100 mb-8 hover:-translate-y-0.5 transition-transform relative z-10">
        <svg class="w-4 h-4 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            <path d="M9 12l2 2 4-4"/>
        </svg>
        <span class="text-xs font-semibold text-slate-700">{{ number_format($totalPhotos) }}+ foto tersedia di KeJepret.</span>
    </div>

    {{-- 2. Title --}}
    <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black leading-[1.1] tracking-tight text-slate-800 mb-6 relative z-10">
        Temukan Foto Larimu<br>
        <span class="text-blue-600">dari Setiap Event</span>
    </h1>

    {{-- 3. Subtitle --}}
    <p class="text-slate-500 text-base sm:text-lg max-w-2xl mx-auto mb-10 leading-relaxed font-medium relative z-10">
        Cari, temukan, dan miliki foto terbaikmu dari ratusan event marathon di seluruh Indonesia. Proses pencarian canggih dengan teknologi <span class="font-bold text-slate-700">Pengenalan Wajah</span> secepat kilat.
    </p>

    {{-- 4. Main CTA Button --}}
    <div class="relative z-10 mb-20 flex justify-center">
        <a href="{{ route('search') }}" class="group relative inline-flex items-center justify-center gap-4 bg-blue-600 text-white font-bold text-base px-2 py-2 pl-8 rounded-full transition-all shadow-[0_8px_30px_rgb(37,99,235,0.3)] hover:shadow-[0_8px_40px_rgb(37,99,235,0.4)] hover:-translate-y-1 hover:bg-blue-700">
            Cari Fotomu Sekarang
            <span class="w-10 h-10 rounded-full bg-white text-blue-600 flex items-center justify-center group-hover:bg-slate-50 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </span>
        </a>
    </div>

    {{-- 5. Floating Mockups Area --}}
    <div class="relative max-w-4xl mx-auto h-[400px] sm:h-[450px] flex justify-center items-end z-10 perspective-[1000px] mb-10">
        
        {{-- Left Mockup (Chat/Review Card) --}}
        <div class="absolute left-0 sm:left-[10%] bottom-16 w-60 sm:w-64 bg-white rounded-2xl p-5 shadow-[0_20px_50px_rgba(0,0,0,0.15)] border border-slate-100 transform -rotate-[10deg] hover:-rotate-6 hover:-translate-y-2 transition-all duration-500 z-20">
            <div class="absolute -left-3 top-1/2 -translate-y-1/2 w-8 h-8 bg-blue-500 rounded-full shadow-lg flex items-center justify-center text-white border-2 border-white">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
            <div class="text-left pl-2">
                <h4 class="text-xs font-bold text-slate-800 mb-1">Sari Dewi</h4>
                <p class="text-[11px] text-slate-600 leading-relaxed font-medium bg-slate-50 p-2.5 rounded-lg rounded-tl-none border border-slate-100">"Di KeJepret langsung ketemu fotonya pakai face recognition. Cepat banget!"</p>
                <div class="mt-2 text-[9px] text-slate-400 text-right">Bali Fun Run • 4:30 pm</div>
            </div>
        </div>

        {{-- Center Mockup (Phone UI) --}}
        <div class="relative w-[280px] sm:w-[300px] h-[400px] sm:h-[450px] bg-slate-50 rounded-[2.5rem] p-2.5 shadow-[0_30px_80px_rgba(37,99,235,0.2)] border-4 border-blue-600 transform z-30 flex flex-col hover:-translate-y-4 transition-transform duration-500">
            {{-- Notch --}}
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-24 h-6 bg-blue-600 rounded-b-xl z-10 flex justify-center items-end pb-1.5">
                <div class="w-12 h-1.5 bg-black/20 rounded-full"></div>
            </div>
            
            {{-- Phone Screen --}}
            <div class="flex-1 bg-white rounded-[1.8rem] overflow-hidden flex flex-col relative border border-slate-100">
                <div class="pt-8 pb-3 px-4 flex items-center justify-between">
                    <h3 class="font-black text-slate-800 text-base">KeJepret</h3>
                    <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                </div>
                
                {{-- AI Search Box --}}
                <div class="px-3 mb-2">
                    <div class="bg-blue-50/50 rounded-xl p-3 border border-blue-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div class="text-left">
                            <div class="text-[10px] font-bold text-slate-800">Cari Wajah AI</div>
                            <div class="text-[9px] text-slate-500">Unggah foto selfie Anda</div>
                        </div>
                    </div>
                </div>
                
                <div class="flex-1 px-3 space-y-2.5 overflow-hidden">
                    <div class="text-[10px] font-bold text-slate-400 px-1 mt-2 mb-1">Event Terbaru</div>
                    @if($events->count() > 0 && $events[0]->cover_image)
                    <div class="relative h-28 rounded-xl overflow-hidden bg-slate-200">
                        <img src="{{ env('AWS_URL') }}/{{ $events[0]->cover_image }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                        <div class="absolute bottom-2 left-2 text-left">
                            <p class="text-[11px] font-bold text-white">{{ Str::limit($events[0]->name, 15) }}</p>
                        </div>
                    </div>
                    @endif
                    @if($events->count() > 1 && $events[1]->cover_image)
                    <div class="relative h-28 rounded-xl overflow-hidden bg-slate-200">
                        <img src="{{ env('AWS_URL') }}/{{ $events[1]->cover_image }}" class="w-full h-full object-cover">
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right Mockup (Event Card/Review) --}}
        <div class="absolute right-0 sm:right-[10%] bottom-24 w-60 sm:w-64 bg-white rounded-2xl p-5 shadow-[0_20px_50px_rgba(0,0,0,0.15)] border border-slate-100 transform rotate-[10deg] hover:rotate-6 hover:-translate-y-2 transition-all duration-500 z-10">
            <div class="absolute -right-3 top-1/2 -translate-y-1/2 w-8 h-8 bg-green-500 rounded-full shadow-lg flex items-center justify-center text-white border-2 border-white">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div class="text-left pr-2">
                <h4 class="text-xs font-bold text-slate-800 mb-1">Andi Wijaya</h4>
                <p class="text-[11px] text-slate-600 leading-relaxed font-medium bg-slate-50 p-2.5 rounded-lg rounded-tr-none border border-slate-100">"Kualitas tajam, resolusi tinggi. Sempurna buat diposting di sosmed!"</p>
                <div class="mt-2 text-[9px] text-slate-400 text-left">Jakarta Marathon • 10:15 am</div>
            </div>
        </div>

    </div>

</section>

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
<section class="py-24 bg-transparent relative z-10 overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-16 relative">
            <span class="inline-flex items-center gap-2 bg-gradient-to-r from-sky-500/10 to-blue-600/10 border border-sky-500/20 text-blue-600 text-[10px] font-black uppercase tracking-[0.3em] px-5 py-2.5 rounded-full mb-5 shadow-sm shadow-blue-500/5">
                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Panduan Cepat
            </span>
            <h2 class="text-3xl sm:text-5xl font-black text-slate-900 mb-4 tracking-tight">Mudah dalam <span class="bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-600 bg-clip-text text-transparent drop-shadow-sm">3 Langkah</span></h2>
            <p class="text-slate-500 text-sm sm:text-base max-w-lg mx-auto font-medium leading-relaxed">Dari pencarian foto pelari hingga selesai diunduh dengan kualitas tinggi, semua bisa dilakukan dalam hitungan detik.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
            {{-- Garis Penghubung Desktop --}}
            <div class="hidden md:block absolute top-12 left-[calc(33.33%+2rem)] right-[calc(33.33%+2rem)] h-[2px] bg-gradient-to-r from-sky-200 via-blue-300 to-indigo-200 z-0 border-t border-dashed border-white/50"></div>

            @foreach($steps as $i => $step)
            @php $colors = [
                ['from' => 'from-sky-400',    'to' => 'to-blue-600',   'light' => 'bg-sky-50',   'border' => 'border-sky-200',   'text' => 'text-sky-600',   'shadow' => 'shadow-sky-500/30', 'watermark' => 'text-sky-100', 'bgCard' => 'bg-gradient-to-b from-white to-sky-50/30'],
                ['from' => 'from-blue-400',   'to' => 'to-indigo-600', 'light' => 'bg-blue-50',  'border' => 'border-blue-200',  'text' => 'text-blue-600',  'shadow' => 'shadow-blue-500/30', 'watermark' => 'text-blue-100', 'bgCard' => 'bg-gradient-to-b from-white to-blue-50/30'],
                ['from' => 'from-indigo-400', 'to' => 'to-violet-600', 'light' => 'bg-indigo-50','border' => 'border-indigo-200','text' => 'text-indigo-600','shadow' => 'shadow-indigo-500/30', 'watermark' => 'text-indigo-100', 'bgCard' => 'bg-gradient-to-b from-white to-indigo-50/30'],
            ][$i]; @endphp

            <div class="relative z-10 group pt-8">
                {{-- Icon Step Mengambang (Penyempurnaan Bentuk) --}}
                <div class="absolute -top-8 left-1/2 -translate-x-1/2 w-[4.5rem] h-[4.5rem] bg-white rounded-3xl flex items-center justify-center shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] z-20 transition-all duration-500 group-hover:-translate-y-2 group-hover:scale-110">
                    <div class="w-14 h-14 rounded-[1.25rem] bg-gradient-to-br {{ $colors['from'] }} {{ $colors['to'] }} flex items-center justify-center shadow-inner group-hover:rotate-6 transition-transform duration-500">
                        <svg class="w-6 h-6 text-white drop-shadow-sm" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $step['icon'] }}"/>
                        </svg>
                    </div>
                </div>

                {{-- Card Content --}}
                <div class="bg-white/80 rounded-[2.5rem] p-10 pt-14 relative overflow-hidden group-hover:shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] transition-all duration-500 h-full border border-white/60 shadow-xl shadow-slate-200/40 backdrop-blur-xl group-hover:bg-white group-hover:-translate-y-1">
                    
                    {{-- Soft Gradient Glow di dalam Card --}}
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-{{ explode('-', $colors['from'])[1] }}-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    {{-- Watermark Angka Besar (Fixed 01) --}}
                    <div class="absolute -bottom-6 -right-6 text-[11rem] font-black leading-none select-none pointer-events-none {{ $colors['watermark'] }} opacity-40 group-hover:scale-110 group-hover:-translate-x-2 group-hover:-translate-y-2 group-hover:-rotate-3 transition-all duration-700">
                        {{ $step['num'] }}
                    </div>

                    <div class="relative z-10 text-center mt-2">
                        <span class="inline-block text-[10px] font-black text-slate-400 uppercase tracking-[0.25em] mb-2.5 bg-slate-100 px-3 py-1 rounded-full group-hover:bg-{{ explode('-', $colors['from'])[1] }}-50 group-hover:text-{{ explode('-', $colors['text'])[1] }}-600 transition-colors">Langkah {{ $step['num'] }}</span>
                        <h3 class="font-black text-slate-800 text-xl mb-3.5 leading-snug group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:{{ $colors['from'] }} group-hover:{{ $colors['to'] }} transition-all">{{ $step['title'] }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed font-medium">{{ $step['desc'] }}</p>
                    </div>
                </div>
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
                
                @auth
                <form id="logout-register-form-home" action="{{ route('logout.register.photographer') }}" method="POST" class="hidden">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin keluar dari akun saat ini untuk membuat akun fotografer baru?')) { document.getElementById('logout-register-form-home').submit(); }" class="inline-flex items-center gap-1.5 bg-white text-blue-600 font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-blue-50 transition-colors shadow cursor-pointer">
                    Daftar Sekarang
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
                @else
                <a href="{{ route('register.photographer') }}" class="inline-flex items-center gap-1.5 bg-white text-blue-600 font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-blue-50 transition-colors shadow">
                    Daftar Sekarang
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
                @endauth
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