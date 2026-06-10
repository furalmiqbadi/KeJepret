@extends('layouts.app')
@section('title', 'Beranda')
@section('content')

<style>
    .comment-slide-left-active {
        transform: translateX(-60px) rotate(-16deg) translateY(-8px) !important;
        box-shadow: 0 25px 60px rgba(37, 99, 235, 0.25) !important;
    }
    .comment-slide-right-active {
        transform: translateX(60px) rotate(16deg) translateY(-8px) !important;
        box-shadow: 0 25px 60px rgba(37, 99, 235, 0.25) !important;
    }
    .ml16 .letter {
        display: inline-block;
        line-height: 1em;
    }
</style>

@php
$steps = [
    ['num'=>'01','title'=>'Cari Event-mu','desc'=>'Ketik nama event marathon atau kota yang kamu ikuti. Filter berdasarkan kota atau tanggal.','icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
    ['num'=>'02','title'=>'Pilih & Beli Foto','desc'=>'Temukan fotomu lewat pengenalan wajah . Bayar mudah, harga mulai Rp 20.000.','icon'=>'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z'],
    ['num'=>'03','title'=>'Unduh & Simpan Selamanya','desc'=>'Foto resolusi tinggi langsung tersimpan di koleksimu. Unduh kapan saja, tanpa batas.','icon'=>'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4'],
];
$testimonials = [
    ['name'=>'Andi Wijaya',   'event'=>'Jakarta Marathon 2025', 'avatar'=>'AW', 'color'=>'bg-blue-100 text-blue-700',   'quote'=>'Langsung ketemu foto saya di finish line. Kualitasnya sangat bagus dan harganya sangat terjangkau.'],
    ['name'=>'Sari Dewi',     'event'=>'Bali Fun Run 2025',     'avatar'=>'SD', 'color'=>'bg-orange-100 text-orange-700','quote'=>'Di KeJepret langsung ketemu cuman modal selfie. Prosesnya cepat banget. Recommended!'],
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
        <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
            <circle cx="12" cy="13" r="4"/>
        </svg>
        <span class="text-xs font-semibold text-slate-700">{{ number_format($totalPhotos) }}+ foto tersedia di KeJepret.</span>
    </div>

    {{-- 2. Title --}}
    <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black leading-[1.1] tracking-tight text-slate-800 mb-6 relative z-10 ml16">
        <span class="line-1 inline-block overflow-hidden pb-1">Temukan Foto Larimu</span>
        <br>
        <span class="line-2 inline-block text-blue-600 overflow-hidden pb-1">dari Setiap Event</span>
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
        <div id="comment-box-left" class="hidden md:block absolute left-0 sm:left-[10%] bottom-16 w-60 sm:w-64 bg-white rounded-2xl p-5 shadow-[0_20px_50px_rgba(0,0,0,0.15)] border border-slate-100 transform -rotate-[10deg] hover:-rotate-6 hover:-translate-y-2 transition-all duration-500 z-20 cursor-pointer select-none">
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
                    <div class="text-[10px] font-bold text-slate-400 px-1 mt-2 mb-1">Galeri Pelari</div>
                    
                    {{-- Box 1 --}}
                    <div class="relative h-28 rounded-xl overflow-hidden bg-slate-200" id="runner-slideshow-1">
                        @if(isset($randomPhotos) && $randomPhotos->count() > 0)
                            @foreach($randomPhotos as $index => $photo)
                                <img src="{{ env('AWS_URL') }}/{{ $photo->watermark_path ?? $photo->r2_path }}" 
                                     class="runner-slide-1 absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                                     alt="Foto Pelari">
                            @endforeach
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
                            <div class="absolute bottom-2 left-2 text-left">
                                <p class="text-[9px] font-bold text-white uppercase tracking-wider">Terbaru</p>
                            </div>
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-100">
                                <span class="text-[9px] text-slate-400 uppercase font-bold">Belum ada foto</span>
                            </div>
                        @endif
                    </div>

                    {{-- Box 2 --}}
                    <div class="relative h-28 rounded-xl overflow-hidden bg-slate-200" id="runner-slideshow-2">
                        @if(isset($randomPhotos) && $randomPhotos->count() > 0)
                            @foreach($randomPhotos as $index => $photo)
                                @php 
                                    $activeIdx = $randomPhotos->count() > 1 ? 1 : 0; 
                                @endphp
                                <img src="{{ env('AWS_URL') }}/{{ $photo->watermark_path ?? $photo->r2_path }}" 
                                     class="runner-slide-2 absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out {{ $index === $activeIdx ? 'opacity-100' : 'opacity-0' }}"
                                     alt="Foto Pelari">
                            @endforeach
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
                            <div class="absolute bottom-2 left-2 text-left">
                                <p class="text-[9px] font-bold text-white uppercase tracking-wider">Rekomendasi</p>
                            </div>
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-100">
                                <span class="text-[9px] text-slate-400 uppercase font-bold">Belum ada foto</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Mockup (Event Card/Review) --}}
        <div id="comment-box-right" class="hidden md:flex absolute right-0 sm:right-[10%] bottom-24 w-60 sm:w-64 bg-white rounded-2xl p-5 shadow-[0_20px_50px_rgba(0,0,0,0.15)] border border-slate-100 transform rotate-[10deg] hover:rotate-6 hover:-translate-y-2 transition-all duration-500 z-10 cursor-pointer select-none">
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
    <div class="max-w-4xl mx-auto clean-glass bg-white/40 backdrop-blur-xl border border-white/60 rounded-3xl p-5 my-4 relative z-10 shadow-sm">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 divide-x divide-slate-200/40">
            <div class="text-center hover:scale-105 transition-transform duration-300">
                <div class="text-2xl sm:text-3xl font-black text-slate-800 mb-0.5"><span class="counter-up" data-target="{{ $totalPhotos }}">{{ number_format($totalPhotos) }}</span>+</div>
                <div class="text-[9px] font-bold uppercase tracking-widest text-slate-500">FOTO TERSEDIA</div>
            </div>
            <div class="text-center hover:scale-105 transition-transform duration-300">
                <div class="text-2xl sm:text-3xl font-black text-slate-800 mb-0.5"><span class="counter-up" data-target="{{ $totalEvents }}">{{ $totalEvents }}</span>+</div>
                <div class="text-[9px] font-bold uppercase tracking-widest text-slate-500">ACARA AKTIF</div>
            </div>
            <div class="text-center hover:scale-105 transition-transform duration-300">
                <div class="text-2xl sm:text-3xl font-black text-slate-800 mb-0.5"><span class="counter-up" data-target="15000">15.000</span>+</div>
                <div class="text-[9px] font-bold uppercase tracking-widest text-slate-500">PELARI TERDAFTAR</div>
            </div>
            <div class="text-center hover:scale-105 transition-transform duration-300">
                <div class="text-2xl sm:text-3xl font-black text-slate-800 mb-0.5"><span class="counter-up" data-target="4.9" data-decimals="1">4.9</span><span class="text-lg text-slate-400 font-bold">/5</span></div>
                <div class="text-[9px] font-bold uppercase tracking-widest text-slate-500">RATING PENGGUNA</div>
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
<section class="py-24 relative overflow-hidden">
    {{-- Decorative backgrounds --}}
    <div class="absolute inset-0 pointer-events-none -z-10">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-sky-200/20 rounded-full blur-[100px] translate-x-1/3 -translate-y-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-indigo-200/20 rounded-full blur-[100px] -translate-x-1/3 translate-y-1/4"></div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            
            {{-- Left Content --}}
            <div class="space-y-8">
                <div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-100 mb-6">
                        <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                        <span class="text-[10px] font-black uppercase tracking-widest text-blue-600">Kenapa KeJepret?</span>
                    </div>
                    <h2 class="text-4xl sm:text-5xl font-black text-slate-800 leading-[1.1] tracking-tight">
                        Platform Foto Lari<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-sky-400">Terpercaya #1</span>
                    </h2>
                </div>
                
                <p class="text-slate-500 text-base sm:text-lg leading-relaxed font-medium">
                    Kami bekerja sama dengan fotografer terbaik di setiap event untuk memastikan momen berhargamu terabadikan dengan kualitas paling sempurna.
                </p>
                
                <ul class="space-y-4">
                    @foreach([
                        ['icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'text' => 'Foto resolusi tinggi ready to print'],
                        ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Harga terjangkau mulai Rp 20.000'],
                        ['icon' => 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4', 'text' => 'Unduh langsung tanpa batas waktu'],
                        ['icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'text' => 'Fotografer profesional di setiap event']
                    ] as $item)
                    <li class="flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-2xl bg-white shadow-sm border border-slate-100 flex items-center justify-center flex-shrink-0 group-hover:scale-110 group-hover:bg-blue-50 transition-all duration-300">
                            <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="text-sm sm:text-base text-slate-700 font-bold group-hover:text-blue-600 transition-colors">{{ $item['text'] }}</span>
                    </li>
                    @endforeach
                </ul>
                
                <div class="pt-4">
                    <a href="{{ route('search') }}" class="group inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-black text-sm uppercase tracking-widest px-8 py-4 rounded-[1.25rem] transition-all duration-300 shadow-[0_10px_30px_rgba(37,99,235,0.3)] hover:shadow-[0_15px_40px_rgba(37,99,235,0.4)] hover:-translate-y-1">
                        Jelajahi Foto
                        <span class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white group-hover:text-blue-600 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                    </a>
                </div>
            </div>

            {{-- Right Content (Single Photo Auto-Slideshow) --}}
            <div class="relative w-full max-w-[320px] mx-auto aspect-[4/5] perspective-[1000px] mt-8 lg:mt-0">
                @if(isset($randomPhotos) && $randomPhotos->count() > 0)
                    <div id="photo-slideshow" class="w-full h-full rounded-[2.5rem] overflow-hidden shadow-[0_30px_60px_rgba(0,0,0,0.2)] border-[8px] border-white relative transform rotate-2 hover:rotate-0 hover:scale-[1.02] transition-all duration-500 z-20">
                        @foreach($randomPhotos as $index => $photo)
                            <img src="{{ env('AWS_URL') }}/{{ $photo->watermark_path ?? $photo->r2_path }}" 
                                 class="slideshow-img absolute inset-0 w-full h-full object-cover transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                                 alt="Galeri KeJepret">
                        @endforeach
                        
                        {{-- Overlay Gradient for depth --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent pointer-events-none"></div>
                    </div>
                    
                    {{-- Floating Camera Decoration --}}
                    <div class="absolute top-1/2 left-0 -translate-x-1/2 -translate-y-1/2 w-16 h-16 bg-white/90 backdrop-blur-md rounded-full shadow-2xl flex items-center justify-center z-40 transform border border-slate-100/50">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-blue-600 to-sky-400 flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                    </div>

                    {{-- Simple Vanilla JS for Slideshow --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const images = document.querySelectorAll('#photo-slideshow .slideshow-img');
                            if (images.length > 1) {
                                let currentIndex = 0;
                                setInterval(() => {
                                    // Sembunyikan gambar saat ini
                                    images[currentIndex].classList.remove('opacity-100');
                                    images[currentIndex].classList.add('opacity-0');
                                    
                                    // Lanjut ke gambar berikutnya
                                    currentIndex = (currentIndex + 1) % images.length;
                                    
                                    // Tampilkan gambar berikutnya
                                    images[currentIndex].classList.remove('opacity-0');
                                    images[currentIndex].classList.add('opacity-100');
                                }, 3000); // Ganti tiap 3 detik
                            }
                        });
                    </script>
                @else
                    {{-- Fallback --}}
                    <div class="w-full h-full bg-slate-100 rounded-[2.5rem] border-[8px] border-white shadow-xl flex items-center justify-center transform rotate-2">
                        <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">Belum ada foto</span>
                    </div>
                @endif
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
<section class="py-24 relative z-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 border border-blue-100 mb-6 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                <span class="text-[10px] font-black uppercase tracking-widest text-blue-600">BERGABUNG</span>
            </div>
            <h2 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight">Untuk Semua Orang</h2>
        </div>
        
        <div class="grid lg:grid-cols-3 gap-6 sm:gap-8 items-stretch">

            {{-- Card 1: Event Organizer --}}
            <div class="group glass-card bg-white/80 backdrop-blur-xl border border-white/60 rounded-[2.5rem] p-8 sm:p-10 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] hover:bg-white flex flex-col h-full relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-sky-100/50 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10 w-16 h-16 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-blue-50 group-hover:border-blue-100 transition-colors duration-300 shadow-sm group-hover:scale-110">
                    <svg class="w-7 h-7 text-slate-400 group-hover:text-blue-600 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="relative z-10 font-black text-slate-800 text-2xl mb-4">Event Organizer</h3>
                <p class="relative z-10 text-slate-500 text-sm leading-relaxed mb-10 flex-grow font-medium">Dokumentasikan event lari Anda dengan fotografer profesional kami. Bagikan kenangan tak terlupakan kepada seluruh peserta.</p>
                <a href="{{ route('event.propose') }}" class="relative z-10 inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-700 transition-colors group/link mt-auto">
                    <span class="border-b-2 border-transparent group-hover/link:border-blue-600 transition-colors pb-0.5">Ajukan Event</span>
                    <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Card 2: Jadi Fotografer (Featured) --}}
            <div class="group relative bg-gradient-to-br from-blue-600 to-indigo-700 rounded-[2.5rem] p-8 sm:p-10 overflow-hidden transition-all duration-500 hover:-translate-y-2 shadow-[0_20px_40px_rgba(37,99,235,0.2)] hover:shadow-[0_30px_60px_rgba(37,99,235,0.4)] flex flex-col h-full lg:-mt-4 lg:mb-[-1rem] z-10 border border-blue-400/30">
                {{-- Decorative Shapes --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-2xl -translate-y-1/2 translate-x-1/3 group-hover:scale-125 transition-transform duration-700"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-indigo-400/40 rounded-full blur-2xl translate-y-1/3 -translate-x-1/4"></div>
                <div class="absolute -right-8 -bottom-8 w-32 h-32 border-[16px] border-white/5 rounded-full group-hover:scale-110 transition-transform duration-700"></div>
                
                <div class="relative z-10 w-16 h-16 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center justify-center mb-8 shadow-inner group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-7 h-7 text-white drop-shadow-md" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="relative z-10 font-black text-white text-2xl mb-4 drop-shadow-sm">Jadi Fotografer</h3>
                <p class="relative z-10 text-blue-50 text-sm leading-relaxed mb-10 flex-grow font-medium">Bergabunglah sebagai mitra fotografer. Abadikan momen pelari dan dapatkan penghasilan tak terbatas dari setiap foto yang terjual di platform kami.</p>
                
                <div class="relative z-10 mt-auto">
                    @auth
                    <form id="logout-register-form-home" action="{{ route('logout.register.photographer') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin keluar dari akun saat ini untuk membuat akun fotografer baru?')) { document.getElementById('logout-register-form-home').submit(); }" class="inline-flex w-full justify-center items-center gap-2 bg-white text-blue-600 font-black text-xs uppercase tracking-widest px-6 py-4 rounded-[1.25rem] hover:bg-slate-50 transition-colors shadow-lg hover:shadow-xl hover:scale-[1.02] duration-300">
                        Daftar Sekarang
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    @else
                    <a href="{{ route('register.photographer') }}" class="inline-flex w-full justify-center items-center gap-2 bg-white text-blue-600 font-black text-xs uppercase tracking-widest px-6 py-4 rounded-[1.25rem] hover:bg-slate-50 transition-colors shadow-lg hover:shadow-xl hover:scale-[1.02] duration-300">
                        Daftar Sekarang
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    @endauth
                </div>
            </div>

            {{-- Card 3: Butuh Bantuan --}}
            <div class="group glass-card bg-white/80 backdrop-blur-xl border border-white/60 rounded-[2.5rem] p-8 sm:p-10 transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_20px_60px_-15px_rgba(0,0,0,0.05)] hover:bg-white flex flex-col h-full relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-100/50 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative z-10 w-16 h-16 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-indigo-50 group-hover:border-indigo-100 transition-colors duration-300 shadow-sm group-hover:scale-110">
                    <svg class="w-7 h-7 text-slate-400 group-hover:text-indigo-600 transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="relative z-10 font-black text-slate-800 text-2xl mb-4">Butuh Bantuan?</h3>
                <p class="relative z-10 text-slate-500 text-sm leading-relaxed mb-10 flex-grow font-medium">Punya pertanyaan seputar cara pembelian foto atau mendaftarkan event? Tim support kami selalu siap membantu Anda kapan saja.</p>
                <button onclick="openHelpModal()" class="relative z-10 inline-flex items-center gap-2 text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors group/link mt-auto bg-transparent border-none cursor-pointer">
                    <span class="border-b-2 border-transparent group-hover/link:border-indigo-600 transition-colors pb-0.5">Hubungi Kami</span>
                    <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

        </div>
    </div>
</section>

{{-- ===== FOOTER CTA ===== --}}
{{-- ===== FOOTER CTA ===== --}}
<section class="relative bg-slate-950 pt-24 pb-10 text-center overflow-hidden">
    {{-- Decorative Ambient Glows --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[80vw] sm:w-[800px] h-[400px] bg-blue-600/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-sky-500/10 rounded-full blur-[100px]"></div>
        <div class="absolute top-1/2 right-0 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[120px]"></div>
        {{-- Subtle Grid Pattern --}}
        <div class="absolute inset-0 opacity-[0.05]" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 32px 32px;"></div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 relative z-10">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 mb-8 backdrop-blur-sm shadow-sm">
            <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse shadow-[0_0_8px_rgba(56,189,248,0.8)]"></span>
            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-sky-400">MULAI SEKARANG</span>
        </div>
        
        <h2 class="text-4xl sm:text-6xl font-black text-white leading-[1.1] tracking-tight mb-6 drop-shadow-lg">
            Temukan Fotomu<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 via-blue-500 to-indigo-500">Sekarang Juga</span>
        </h2>
        
        <p class="text-slate-400 text-base sm:text-lg mb-12 max-w-xl mx-auto font-medium leading-relaxed">
            Ribuan foto dari ratusan event lari menunggu kamu. Proses pencarian instan dengan teknologi pengenalan wajah. Gratis untuk dicari.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('search') }}" class="group relative w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-blue-600 hover:bg-blue-500 text-white font-black text-sm uppercase tracking-widest px-8 py-5 rounded-2xl transition-all duration-300 shadow-[0_0_40px_rgba(37,99,235,0.4)] hover:shadow-[0_0_60px_rgba(37,99,235,0.6)] hover:-translate-y-1">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Cari Fotomu
            </a>
            
            <a href="{{ route('event') }}" class="group w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-white/5 hover:bg-white/10 text-white font-black text-sm uppercase tracking-widest px-8 py-5 rounded-2xl transition-all duration-300 border border-white/10 hover:border-white/20 backdrop-blur-md">
                Lihat Event
                <svg class="w-4 h-4 text-slate-400 group-hover:text-white group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>

    {{-- Footer Info --}}
    <div class="max-w-6xl mx-auto px-4 mt-24 relative z-10">
        <div class="h-px w-full bg-gradient-to-r from-transparent via-white/10 to-transparent mb-8"></div>
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center text-white font-black text-xl shadow-lg border border-blue-400/30">
                    K
                </div>
                <span class="font-black text-white text-xl tracking-tight">KeJepret</span>
            </div>
            <p class="text-slate-500 text-sm font-medium text-center md:text-left">
                © {{ date('Y') }} KeJepret. Platform foto lari terpercaya di Indonesia.
            </p>
            <div class="flex gap-4">
                {{-- Placeholder Social Icons --}}
                <a href="#" aria-label="Twitter" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-500 hover:shadow-[0_0_20px_rgba(59,130,246,0.5)] transition-all duration-300">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                </a>
                <a href="#" aria-label="Instagram" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-slate-400 hover:text-white hover:bg-pink-600 hover:shadow-[0_0_20px_rgba(219,39,119,0.5)] transition-all duration-300">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Modal Bantuan WhatsApp --}}
<div id="help-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300">
    <div class="relative w-full max-w-lg clean-glass p-8 rounded-[2.5rem] shadow-2xl transform scale-95 opacity-0 transition-all duration-300 ease-out" id="help-modal-card">
        {{-- Close button --}}
        <button onclick="closeHelpModal()" class="absolute top-6 right-6 w-9 h-9 rounded-full bg-slate-100/80 hover:bg-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-800 transition-colors shadow-sm cursor-pointer z-20 border-none">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Background ambient glow inside modal --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-400/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="space-y-6 relative z-10 text-center">
            <div class="mx-auto w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-600 text-white rounded-2xl flex items-center justify-center shadow-lg border border-indigo-400/30">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </div>
            
            <div class="space-y-2">
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Kirim Pertanyaan</h3>
                <p class="text-slate-500 text-xs leading-relaxed max-w-sm mx-auto font-medium">Tulis pertanyaan atau keluhan Anda di bawah. Pesan Anda akan langsung dikirimkan ke WhatsApp tim support KeJepret.</p>
            </div>

            <div class="space-y-4 text-left">
                <div>
                    <label for="home-modal-complaint-text" class="block text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2 ml-1">Pertanyaan / Keluhan</label>
                    <textarea id="home-modal-complaint-text" rows="4" class="w-full clean-glass-input rounded-2xl p-4 text-sm focus:outline-none resize-none" placeholder="Tulis pertanyaan Anda seputar pembelian foto, pendaftaran event, atau kendala lainnya di sini..."></textarea>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <button onclick="closeHelpModal()" class="w-full order-2 sm:order-1 py-4 bg-slate-100 hover:bg-slate-200 text-slate-655 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all active:scale-[0.98] cursor-pointer text-center border-none">
                        Batal
                    </button>
                    <button onclick="sendHomeModalToWhatsapp()" class="w-full order-1 sm:order-2 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all shadow-md active:scale-[0.98] cursor-pointer flex items-center justify-center gap-2 border-none">
                        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Kirim WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script>
function openHelpModal() {
    const modal = document.getElementById('help-modal');
    const card = document.getElementById('help-modal-card');
    modal.classList.remove('opacity-0', 'pointer-events-none');
    setTimeout(() => {
        card.classList.remove('scale-95', 'opacity-0');
    }, 50);
}

function closeHelpModal() {
    const modal = document.getElementById('help-modal');
    const card = document.getElementById('help-modal-card');
    card.classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        modal.classList.add('opacity-0', 'pointer-events-none');
        document.getElementById('home-modal-complaint-text').value = '';
    }, 200);
}

function sendHomeModalToWhatsapp() {
    const keluhan = document.getElementById('home-modal-complaint-text').value.trim();
    if (!keluhan) {
        alert('Silakan tulis pertanyaan atau keluhan Anda terlebih dahulu.');
        return;
    }
    
    @auth
        const name = "{{ auth()->user()->name }}";
        const email = "{{ auth()->user()->email }}";
        const role = "{{ auth()->user()->role }}";
    @else
        const name = "Pengunjung Umum";
        const email = "-";
        const role = "Guest";
    @endauth
    
    const message = `Halo Admin KeJepret, saya membutuhkan bantuan/memiliki pertanyaan mengenai platform KeJepret.

Detail Pengirim:
- Nama: ${name}
- Email: ${email}
- Status: ${role}

Pertanyaan/Keluhan:
${keluhan}`;

    const encodedMessage = encodeURIComponent(message);
    const whatsappUrl = `https://wa.me/6285319252270?text=${encodedMessage}`;
    
    window.open(whatsappUrl, '_blank');
    closeHelpModal();
}

document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter-up');
    const speed = 1500; // durasi animasi dalam milidetik

    const animate = (counter) => {
        const target = +counter.getAttribute('data-target');
        const decimals = parseInt(counter.getAttribute('data-decimals') || '0', 10);
        const start = 0;
        let startTime = null;

        const format = (value) => {
            if (decimals > 0) {
                return value.toFixed(decimals);
            }
            return Math.floor(value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        };

        const updateCount = (timestamp) => {
            if (!startTime) startTime = timestamp;
            const progress = timestamp - startTime;
            const percentage = Math.min(progress / speed, 1);

            const currentValue = start + (target - start) * percentage;
            counter.innerText = format(currentValue);

            if (percentage < 1) {
                requestAnimationFrame(updateCount);
            } else {
                counter.innerText = format(target);
            }
        };

        requestAnimationFrame(updateCount);
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animate(entry.target);
                observer.unobserve(entry.target); // Hanya jalankan animasi sekali
            }
        });
    }, { threshold: 0.1 });

    counters.forEach(counter => {
        observer.observe(counter);
    });

    // Auto-slide for Runner Slideshow 1 inside Phone Mockup
    const runnerSlides1 = document.querySelectorAll('#runner-slideshow-1 .runner-slide-1');
    if (runnerSlides1.length > 1) {
        let currentIdx1 = 0;
        setInterval(() => {
            runnerSlides1[currentIdx1].classList.remove('opacity-100');
            runnerSlides1[currentIdx1].classList.add('opacity-0');
            currentIdx1 = (currentIdx1 + 1) % runnerSlides1.length;
            runnerSlides1[currentIdx1].classList.remove('opacity-0');
            runnerSlides1[currentIdx1].classList.add('opacity-100');
        }, 3000);
    }

    // Auto-slide for Runner Slideshow 2 inside Phone Mockup (Staggered start)
    const runnerSlides2 = document.querySelectorAll('#runner-slideshow-2 .runner-slide-2');
    if (runnerSlides2.length > 1) {
        let currentIdx2 = runnerSlides2.length > 1 ? 1 : 0;
        setInterval(() => {
            runnerSlides2[currentIdx2].classList.remove('opacity-100');
            runnerSlides2[currentIdx2].classList.add('opacity-0');
            currentIdx2 = (currentIdx2 + 1) % runnerSlides2.length;
            runnerSlides2[currentIdx2].classList.remove('opacity-0');
            runnerSlides2[currentIdx2].classList.add('opacity-100');
        }, 3000);
    }

    // Slide left/right comment box on click
    const commentBoxLeft = document.getElementById('comment-box-left');
    const commentBoxRight = document.getElementById('comment-box-right');

    if (commentBoxLeft) {
        commentBoxLeft.addEventListener('click', () => {
            commentBoxLeft.classList.add('comment-slide-left-active');
            setTimeout(() => {
                commentBoxLeft.classList.remove('comment-slide-left-active');
            }, 800);
        });
    }

    if (commentBoxRight) {
        commentBoxRight.addEventListener('click', () => {
            commentBoxRight.classList.add('comment-slide-right-active');
            setTimeout(() => {
                commentBoxRight.classList.remove('comment-slide-right-active');
            }, 800);
        });
    }

    // Wrap every letter in .line-1 and .line-2 in a span with class 'letter'
    const line1 = document.querySelector('.ml16 .line-1');
    const line2 = document.querySelector('.ml16 .line-2');
    if (line1) {
        line1.innerHTML = line1.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
    }
    if (line2) {
        line2.innerHTML = line2.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
    }

    if (line1 || line2) {
        anime.timeline({loop: true})
          .add({
            targets: '.ml16 .letter',
            translateY: [-100,0],
            easing: "easeOutExpo",
            duration: 1400,
            delay: (el, i) => 30 * i
          }).add({
            targets: '.ml16',
            opacity: [1, 0],
            duration: 1000,
            easing: "easeOutExpo",
            delay: 1000
          });
    }
});
</script>

@endsection