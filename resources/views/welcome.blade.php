<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeJepret — Temukan Foto Larimu dari Setiap Event</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            --color-blue-600: #2563eb;
            --color-blue-700: #1d4ed8;
        }

        body {
            font-family: var(--font-sans);
            background-color: #fafafa;
            color: #0f172a;
        }

        .glass {
            @apply bg-white/70 backdrop-blur-3xl border border-white/40 shadow-xl;
        }

        .btn-blue {
            @apply px-8 py-4 bg-blue-600 text-white rounded-full font-black text-sm uppercase italic tracking-wider transition-all hover:bg-blue-700 active:scale-95 shadow-lg shadow-blue-500/20;
        }

        .section-title {
            @apply text-5xl font-black text-slate-900 tracking-tighter uppercase italic leading-none;
        }
    </style>
</head>
<body class="antialiased scroll-smooth">
    
    @include('partials.navbar')

    <!-- HERO SECTION -->
    <section class="relative pt-48 pb-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center z-10 relative">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-[10px] font-black uppercase tracking-[0.2em] border border-blue-100 mb-8">
                <span class="material-symbols-outlined text-sm">auto_awesome</span>
                150.000+ PAKET WAJAH SUDAH TERDETEKSI
            </div>

            <h1 class="text-6xl md:text-8xl font-black text-slate-900 tracking-tighter uppercase italic leading-[0.85] mb-8">
                TEMUKAN FOTO LARIMU <span class="text-blue-600">DARI <br> SETIAP EVENT</span>
            </h1>

            <p class="text-slate-500 font-bold max-w-xl mx-auto mb-10 text-lg leading-relaxed">
                Cari, temukan, dan miliki foto terbaikmu dari setiap event lari maraton di seluruh Indonesia. Akurasi tinggi, harga terjangkau.
            </p>

            <!-- Search Area -->
            <div class="max-w-2xl mx-auto flex flex-col sm:flex-row gap-4 p-2 bg-white rounded-full border border-slate-100 shadow-2xl shadow-slate-200/50">
                <div class="flex-1 flex items-center px-6 gap-3">
                    <span class="material-symbols-outlined text-slate-400">search</span>
                    <input type="text" placeholder="Cari nama event atau kota..." class="w-full h-full outline-none text-sm font-bold text-slate-900">
                </div>
                <button class="btn-blue py-3 px-10">Cari Sekarang</button>
            </div>

            <!-- Dashboard Mockup-style Stats -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-4 gap-6 max-w-5xl mx-auto">
                <div class="glass p-8 rounded-[3rem] text-left hover:scale-105 transition-all">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Cakupan</p>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tighter italic leading-none mb-4">Ribuan Foto Siap Download</h3>
                    <p class="text-xs text-slate-500 font-medium leading-relaxed">Temukan momen lari kamu berdasarkan nomor BIB atau wajah.</p>
                </div>
                <div class="glass p-8 rounded-[3rem] text-left bg-blue-600 text-white relative flex flex-col justify-end">
                    <div class="absolute top-8 left-8">
                        <p class="text-[10px] font-black uppercase tracking-widest text-blue-200 mb-2 italic">KEPUASAN</p>
                        <h3 class="text-3xl font-black tracking-tighter leading-none italic">4.9/5</h3>
                    </div>
                    <p class="text-xs font-bold text-blue-100">Rating dari 15.000+ pelari seluruh Indonesia.</p>
                </div>
                <div class="glass p-8 rounded-[3rem] text-left flex flex-col justify-end">
                    <h3 class="text-3xl font-black text-slate-900 tracking-tighter italic leading-none mb-4">50+</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest leading-none">Event Aktif 2024</p>
                </div>
                <div class="glass p-8 rounded-[3rem] text-left bg-slate-900 text-white flex flex-col justify-end">
                    <h3 class="text-3xl font-black tracking-tighter italic leading-none mb-4">120.000+</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest leading-none">Foto Tersedia</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TRUST STATS BAR -->
    <section class="py-12 border-y border-slate-100 bg-white/50">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 lg:grid-cols-4 gap-12">
            <div class="flex items-center gap-4 justify-center">
                <span class="material-symbols-outlined text-blue-600">group</span>
                <div class="text-left">
                    <p class="text-lg font-black leading-none">120.000+</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Pelari Terdaftar</p>
                </div>
            </div>
            <div class="flex items-center gap-4 justify-center border-l border-slate-100 px-12">
                <span class="material-symbols-outlined text-blue-600">stadium</span>
                <div class="text-left">
                    <p class="text-lg font-black leading-none">25+ Kota</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Di Seluruh Indonesia</p>
                </div>
            </div>
            <div class="flex items-center gap-4 justify-center border-l border-slate-100 px-12">
                <span class="material-symbols-outlined text-blue-600">photo_library</span>
                <div class="text-left">
                    <p class="text-lg font-black leading-none">15.000+</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Bagian Terdeteksi</p>
                </div>
            </div>
            <div class="flex items-center gap-4 justify-center border-l border-slate-100 px-12">
                <span class="material-symbols-outlined text-blue-600">verified</span>
                <div class="text-left">
                    <p class="text-lg font-black leading-none">4.9/5</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Rating Pelanggan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CARA KERJA -->
    <section class="py-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.4em] mb-4">CARA KERJA</p>
            <h2 class="section-title mb-16">MUDAH DALAM 3 LANGKAH</h2>

            <div class="grid md:grid-cols-3 gap-12">
                <div class="space-y-6 group">
                    <div class="relative w-full aspect-video rounded-[3rem] overflow-hidden bg-white border border-slate-100 shadow-xl group-hover:-translate-y-2 transition-transform p-8 flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <span class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <span class="material-symbols-outlined">search</span>
                            </span>
                            <span class="text-4xl font-black text-slate-200">01</span>
                        </div>
                        <div class="text-left">
                            <h4 class="text-xl font-black text-slate-900 italic uppercase">Cari Event-mu</h4>
                            <p class="text-sm text-slate-500 font-bold mt-2">Ketik nama event maraton atau lari yang kamu ikuti. Filter berdasarkan kota atau tanggal.</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-6 group">
                    <div class="relative w-full aspect-video rounded-[3rem] overflow-hidden bg-white border border-slate-100 shadow-xl group-hover:-translate-y-2 transition-transform p-8 flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <span class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <span class="material-symbols-outlined">face</span>
                            </span>
                            <span class="text-4xl font-black text-slate-200">02</span>
                        </div>
                        <div class="text-left">
                            <h4 class="text-xl font-black text-slate-900 italic uppercase">Pilih & Beli Foto</h4>
                            <p class="text-sm text-slate-500 font-bold mt-2">Temukan fotomu lewat nomor BIB atau AI wajah. Bayar murah, harga mulai Rp 20.000.</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-6 group">
                    <div class="relative w-full aspect-video rounded-[3rem] overflow-hidden bg-white border border-slate-100 shadow-xl group-hover:-translate-y-2 transition-transform p-8 flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <span class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                <span class="material-symbols-outlined">download</span>
                            </span>
                            <span class="text-4xl font-black text-slate-200">03</span>
                        </div>
                        <div class="text-left">
                            <h4 class="text-xl font-black text-slate-900 italic uppercase">Download Selamanya</h4>
                            <p class="text-sm text-slate-500 font-bold mt-2">Foto kualitas tinggi langsung kamu miliki di instrumen apapun kapan saja selamanya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EVENT TERBARU -->
    <section class="py-32 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-16">
                <div>
                    <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.4em] mb-2">EVENT LARI</p>
                    <h2 class="section-title">EVENT TERBARU</h2>
                </div>
                <a href="#" class="flex items-center gap-2 text-xs font-black uppercase text-slate-400 hover:text-blue-600 transition-colors">Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $events = [
                        ['name' => 'Jakarta Marathon 2026', 'date' => '15 Jun 2026', 'city' => 'Jakarta', 'photos' => '2.340 Foto', 'img' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?q=80&w=600'],
                        ['name' => 'Bali Fun Run', 'date' => '22 Jul 2026', 'city' => 'Bali', 'photos' => '1.120 Foto', 'img' => 'https://images.unsplash.com/photo-1594882645126-14020914d58d?q=80&w=600'],
                        ['name' => 'Bandung Trail Run', 'date' => '5 Agu 2026', 'city' => 'Bandung', 'photos' => '890 Foto', 'img' => 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?q=80&w=600'],
                        ['name' => 'Surabaya Night Run', 'date' => '19 Agu 2026', 'city' => 'Surabaya', 'photos' => '1.560 Foto', 'img' => 'https://images.unsplash.com/photo-1533560272406-399fe403758b?q=80&w=600'],
                    ];
                @endphp

                @foreach($events as $event)
                    <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-xl border border-slate-100 group">
                        <div class="aspect-video relative overflow-hidden">
                            <img src="{{ $event['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-4 right-4 flex gap-2">
                                <span class="bg-blue-600/90 backdrop-blur text-white px-3 py-1 rounded-full text-[8px] font-black uppercase">Populer</span>
                                <span class="bg-white/90 backdrop-blur text-slate-900 px-3 py-1 rounded-full text-[8px] font-black uppercase">{{ $event['city'] }}</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-[12px]">calendar_today</span> {{ $event['date'] }}
                            </p>
                            <h4 class="text-lg font-black text-slate-900 italic uppercase leading-tight group-hover:text-blue-600 transition-colors">{{ $event['name'] }}</h4>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2">{{ $event['photos'] }} tersedia</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PLATFORM INTRO -->
    <section class="py-32">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4 pt-12">
                    <img src="https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?q=80&w=400" class="rounded-[2.5rem] w-full aspect-[3/4] object-cover shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1533560272406-399fe403758b?q=80&w=400" class="rounded-[2.5rem] w-full aspect-square object-cover shadow-2xl">
                </div>
                <div class="space-y-4">
                    <img src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?q=80&w=400" class="rounded-[2.5rem] w-full aspect-square object-cover shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1594882645126-14020914d58d?q=80&w=400" class="rounded-[2.5rem] w-full aspect-[3/4] object-cover shadow-2xl">
                </div>
            </div>
            <div class="space-y-8">
                <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.4em]">KENAPA KEJEPRET?</p>
                <h2 class="section-title leading-[0.9]">PLATFORM FOTO LARI TERPERCAYA #1</h2>
                <p class="text-slate-500 font-bold leading-relaxed">Kami bekerja sama dengan fotografer terbaik di setiap event untuk memastikan sejarah lari kamu terabadikan dengan sempurna.</p>
                
                <ul class="space-y-4">
                    <li class="flex items-center gap-4">
                        <div class="w-6 h-6 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[14px] font-bold">check</span>
                        </div>
                        <span class="text-sm font-bold text-slate-700">Foto resolusi tinggi siap cetak</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-6 h-6 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[14px] font-bold">check</span>
                        </div>
                        <span class="text-sm font-bold text-slate-700">Harga terjangkau mulai Rp 20.000</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-6 h-6 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[14px] font-bold">check</span>
                        </div>
                        <span class="text-sm font-bold text-slate-700">Unduh langsung tanpa batas waktu</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="w-6 h-6 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                            <span class="material-symbols-outlined text-[14px] font-bold">check</span>
                        </div>
                        <span class="text-sm font-bold text-slate-700">Fotografer profesional di setiap event</span>
                    </li>
                </ul>

                <a href="{{ route('kejepret') }}" class="btn-blue inline-flex items-center gap-3">Telusuri Foto <span class="material-symbols-outlined text-sm">arrow_outward</span></a>
            </div>
        </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="py-32 bg-slate-50/30">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.4em] mb-4">TESTIMONI</p>
            <h2 class="section-title mb-16">KATA MEREKA</h2>

            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $testis = [
                        ['name' => 'Andi Wijaya', 'text' => 'Gampang bener cari foto saya di Borobudur Run. Kualitasnya sangat bagus dan harganya sangat terjangkau!', 'role' => 'Finishers Jakarta 2024'],
                        ['name' => 'Sari Dewi', 'text' => 'Di KeJepret langsung ketemu fotonya lewat nomor BIB. Prosesnya cepat banget. Recommended!', 'role' => 'Lari Pagi Club'],
                        ['name' => 'Rudi Santoso', 'text' => 'Foto resolusi tinggi dan bisa download cepat. Akhirnya punya banyak foto keren di setiap event.', 'role' => 'Marathon Runner'],
                    ];
                @endphp

                @foreach($testis as $testi)
                    <div class="bg-white p-10 rounded-[3rem] text-left border border-slate-100 shadow-xl space-y-6">
                        <div class="flex gap-1 text-amber-400">
                            @for($i=0; $i<5; $i++) <span class="material-symbols-outlined text-sm fill-1">star</span> @endfor
                        </div>
                        <p class="text-slate-600 font-bold leading-relaxed">"{{ $testi['text'] }}"</p>
                        <div class="flex items-center gap-4 pt-4 border-t border-slate-50">
                            <div class="w-10 h-10 rounded-full bg-slate-100"></div>
                            <div>
                                <h5 class="text-sm font-black text-slate-900 leading-none mb-1">{{ $testi['name'] }}</h5>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $testi['role'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ROLE CARDS -->
    <section class="py-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.4em] mb-4">BERGABUNG</p>
            <h2 class="section-title mb-16">UNTUK SEMUA ORANG</h2>

            <div class="grid md:grid-cols-3 gap-8 text-left">
                <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-xl hover:shadow-2xl transition-all group">
                    <div class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-[24px]">stadium</span>
                    </div>
                    <h4 class="text-xl font-black text-slate-900 italic uppercase">Event Organizer</h4>
                    <p class="text-sm text-slate-500 font-bold mt-4 mb-8">Dokumentasikan event maraton Anda dengan fotografer profesional kami. Berikan kenangan terbaik peserta Anda.</p>
                    <a href="#" class="text-xs font-black text-blue-600 uppercase italic flex items-center gap-2 group-hover:gap-4 transition-all">Pendaftaran Event <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                </div>
                <div class="bg-blue-600 p-10 rounded-[3rem] shadow-xl hover:shadow-2xl transition-all group text-white">
                    <div class="w-12 h-12 rounded-2xl bg-white/20 text-white flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-[24px]">photo_camera</span>
                    </div>
                    <h4 class="text-xl font-black italic uppercase">Jadi Fotografer</h4>
                    <p class="text-sm text-blue-100 font-bold mt-4 mb-8">Bergabunglah sebagai mitra fotografer kami dan dapatkan penghasilan dari setiap foto yang terjual.</p>
                    <a href="#" class="text-xs font-black text-white uppercase italic flex items-center gap-2 group-hover:gap-4 transition-all">Daftar Sekarang <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                </div>
                <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-xl hover:shadow-2xl transition-all group">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-[24px]">help_center</span>
                    </div>
                    <h4 class="text-xl font-black text-slate-900 italic uppercase">Butuh bantuan?</h4>
                    <p class="text-sm text-slate-500 font-bold mt-4 mb-8">Punya pertanyaan tentang foto atau event? Tim support kami siap membantu 24/7 kapan saja.</p>
                    <a href="#" class="text-xs font-black text-slate-400 uppercase italic flex items-center gap-2 group-hover:text-blue-600 group-hover:gap-4 transition-all">Hubungi Kami <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER CTA -->
    <section class="mx-6 mb-12">
        <div class="max-w-7xl mx-auto glass bg-slate-900 text-white rounded-[4rem] p-24 text-center overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600 rounded-full blur-[100px]"></div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-600 rounded-full blur-[100px]"></div>
            </div>
            
            <h2 class="text-6xl font-black tracking-tighter uppercase italic leading-none mb-8 relative z-10">TEMUKAN FOTOMU <br> SEKARANG JUGA</h2>
            <p class="text-slate-400 font-bold max-w-lg mx-auto mb-12 relative z-10">Ribuan pelari telah menemukan momen kebahagiaan mereka bersama KeJepret. Kini giliranmu mencari foto di event terakhir.</p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 relative z-10">
                <a href="{{ route('kejepret') }}" class="btn-blue bg-blue-600 shadow-blue-900/50">Cari Fotomu</a>
                <a href="#" class="btn-blue bg-white/5 border border-white/10 hover:bg-white/10 shadow-none">Lihat Event</a>
            </div>
        </div>
    </section>

    <!-- BOTTOM FOOTER -->
    <footer class="py-12 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-600 rounded-xl flex items-center justify-center text-white">
                    <span class="material-symbols-outlined text-[16px]">camera</span>
                </div>
                <span class="text-xl font-black tracking-tighter uppercase italic">KeJepret</span>
            </div>
            
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">© 2026 KEJEPRET STUDIO. SEMUA HAK DILINDUNGI.</p>

            <div class="flex gap-8">
                <a href="#" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-blue-600">Privacy</a>
                <a href="#" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-blue-600">Terms</a>
            </div>
        </div>
    </footer>

</body>
</html>
