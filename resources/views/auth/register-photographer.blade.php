<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Fotografer – KeJepret</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            --color-sky-500: #0ea5e9;
            --color-sky-600: #0284c7;
        }
        html, body {
            font-family: var(--font-sans);
            background: #eef2f6;
            color: #0f172a;
            min-height: 100vh;
        }
        .clean-glass {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(32px) saturate(140%);
            -webkit-backdrop-filter: blur(32px) saturate(140%);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 30px 60px -15px rgba(15, 23, 42, 0.05), 0 0 0 1px rgba(255, 255, 255, 0.6) inset;
        }
        .clean-glass-input {
            background: rgba(248, 250, 252, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(15, 23, 42, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #1e293b;
        }
        .clean-glass-input::placeholder {
            color: #94a3b8;
        }
        .clean-glass-input:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.08);
        }
        .clean-glass-box {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(15, 23, 42, 0.06);
            color: #334155;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col items-center justify-center py-12 px-6 relative select-none">

    <!-- Neumorphic 3D Clean & Elegant Background Ornament -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <!-- Ambient Soft Premium Glows -->
        <div class="absolute -top-[10%] -left-[10%] w-[60%] h-[60%] rounded-full bg-blue-400/8 blur-[130px]"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[65%] h-[65%] rounded-full bg-indigo-400/8 blur-[130px]"></div>
        
        <!-- Embossed 3D Curves SVG -->
        <svg class="absolute inset-0 w-full h-full opacity-65" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <!-- Neumorphic Drop Shadow Filter -->
                <filter id="neumorphic-shadow-1" x="-20%" y="-20%" width="140%" height="140%">
                    <feDropShadow dx="3" dy="4" stdDeviation="5" flood-color="#cbd5e1" flood-opacity="0.4"/>
                    <feDropShadow dx="-3" dy="-4" stdDeviation="5" flood-color="#ffffff" flood-opacity="0.9"/>
                </filter>
            </defs>

            <!-- Minimal Concentric Neumorphic Circles (Pojok Kanan Bawah - Sangat Elegan) -->
            <circle cx="100%" cy="100%" r="200" fill="none" stroke="#eef2f6" stroke-width="8" filter="url(#neumorphic-shadow-1)" />
            <circle cx="100%" cy="100%" r="350" fill="none" stroke="#eef2f6" stroke-width="12" filter="url(#neumorphic-shadow-1)" />
            <circle cx="100%" cy="100%" r="500" fill="none" stroke="#eef2f6" stroke-width="16" filter="url(#neumorphic-shadow-1)" />

            <!-- Minimal Concentric Neumorphic Circles (Pojok Kiri Atas - Sangat Tipis) -->
            <circle cx="0" cy="0" r="150" fill="none" stroke="#eef2f6" stroke-width="8" filter="url(#neumorphic-shadow-1)" />
            <circle cx="0" cy="0" r="280" fill="none" stroke="#eef2f6" stroke-width="12" filter="url(#neumorphic-shadow-1)" />

            <!-- 3D Parallel Curves (Grup 1 - Indah & Bersih) -->
            <path d="M-100 300 C 350 200, 450 600, 850 400 C 1250 200, 1450 800, 2100 700" 
                  fill="none" stroke="#eef2f6" stroke-width="20" stroke-linecap="round" filter="url(#neumorphic-shadow-1)" />
            <path d="M-100 340 C 350 240, 450 640, 850 440 C 1250 240, 1450 840, 2100 740" 
                  fill="none" stroke="#eef2f6" stroke-width="12" stroke-linecap="round" filter="url(#neumorphic-shadow-1)" />

            <!-- 3D Parallel Curves (Grup 2 - Bawah) -->
            <path d="M-50 850 C 450 650, 650 950, 1150 750 C 1650 550, 1850 1150, 2300 950" 
                  fill="none" stroke="#eef2f6" stroke-width="16" stroke-linecap="round" filter="url(#neumorphic-shadow-1)" />
            <path d="M-50 890 C 450 690, 650 990, 1150 790 C 1650 590, 1850 1190, 2300 990" 
                  fill="none" stroke="#eef2f6" stroke-width="10" stroke-linecap="round" filter="url(#neumorphic-shadow-1)" />
        </svg>
    </div>

    <div class="w-full max-w-md space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-1000 relative z-10">

        {{-- Register Card --}}
        <div class="clean-glass p-8 md:p-10 rounded-[2.5rem] space-y-6 relative overflow-hidden">

            {{-- Logo & Judul --}}
            <div class="flex flex-col items-center gap-3.5 text-center mb-2 relative z-10">
                <a href="/" class="group block">
                    <h1 class="text-4xl font-extrabold tracking-tighter bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-600 bg-clip-text text-transparent drop-shadow-sm transition-transform duration-500 group-hover:scale-105">
                        KeJepret
                    </h1>
                </a>
                <div>
                    <h2 class="text-lg font-black text-slate-800 tracking-tight">Daftar sebagai Fotografer</h2>
                    <p class="text-slate-500 font-semibold text-xs mt-1">Bergabunglah dan mulai hasilkan pendapatan dari foto acara Anda.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="flex items-start gap-3 clean-glass-box text-slate-700 rounded-2xl px-5 py-4">
                    <svg class="w-5 h-5 mt-0.5 shrink-0 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    <ul class="text-xs font-semibold space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.photographer.post', [], false) }}" method="POST" enctype="multipart/form-data" class="space-y-5 relative z-10">
                @csrf

                {{-- Nama & Email --}}

                    {{-- Nama --}}
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Nama Lengkap</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-sky-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input type="text" name="name" placeholder="Budi Santoso"
                                value="{{ old('name') }}"
                                class="w-full clean-glass-input rounded-2xl pl-11 pr-5 py-3.5 text-xs font-semibold text-slate-800 outline-none placeholder:text-slate-400/70 shadow-sm shadow-slate-200/50">
                        </div>
                    </div>

                    {{-- Email / Surel --}}
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Alamat Surel</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-sky-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input type="email" name="email" placeholder="nama@email.com"
                                value="{{ old('email') }}"
                                class="w-full clean-glass-input rounded-2xl pl-11 pr-5 py-3.5 text-xs font-semibold text-slate-800 outline-none placeholder:text-slate-400/70 shadow-sm shadow-slate-200/50">
                        </div>
                    </div>


                {{-- Kata Sandi & Konfirmasi --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Password --}}
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Kata Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-sky-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password" id="password_foto" placeholder="••••••••"
                                class="w-full clean-glass-input rounded-2xl pl-11 pr-12 py-3.5 text-xs font-semibold text-slate-800 outline-none placeholder:text-slate-400/70 shadow-sm shadow-slate-200/50">
                            <button type="button" onclick="togglePassword('password_foto', 'eye_foto_open', 'eye_foto_close')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 cursor-pointer transition-colors flex items-center justify-center z-10">
                                <svg id="eye_foto_open" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eye_foto_close" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Konfirmasi Sandi</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-sky-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input type="password" name="password_confirmation" id="password_foto_confirm" placeholder="••••••••"
                                class="w-full clean-glass-input rounded-2xl pl-11 pr-12 py-3.5 text-xs font-semibold text-slate-800 outline-none placeholder:text-slate-400/70 shadow-sm shadow-slate-200/50">
                            <button type="button" onclick="togglePassword('password_foto_confirm', 'eye_foto_confirm_open', 'eye_foto_confirm_close')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 cursor-pointer transition-colors flex items-center justify-center z-10">
                                <svg id="eye_foto_confirm_open" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eye_foto_confirm_close" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- No. Telepon --}}
                <div class="space-y-1.5">
                    <label class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Nomor Telepon <span class="normal-case tracking-normal font-semibold text-slate-400/75">(opsional)</span></label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-sky-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <input type="text" name="phone" placeholder="08xxxxxxxxxx"
                            value="{{ old('phone') }}"
                            class="w-full clean-glass-input rounded-2xl pl-11 pr-5 py-3.5 text-xs font-semibold text-slate-800 outline-none placeholder:text-slate-400/70 shadow-sm shadow-slate-200/50">
                    </div>
                </div>

                {{-- Info Box (Frosted Glass Light - Highlighted) - Moved immediately above Unggah KTP --}}
                <div class="flex items-start gap-3 rounded-2xl px-5 py-4 border border-indigo-200/60 bg-indigo-50/40 backdrop-blur-md relative overflow-hidden group transition-all duration-300 hover:border-indigo-300 hover:bg-indigo-50/60 hover:shadow-md hover:shadow-indigo-100/30">
                    <div class="absolute -right-4 -bottom-4 w-12 h-12 bg-indigo-200/20 rounded-full blur-xl group-hover:scale-125 transition-transform duration-500"></div>
                    <svg class="w-5 h-5 mt-0.5 shrink-0 text-indigo-600 animate-pulse" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    <p class="text-[11px] leading-relaxed text-indigo-950/80 font-bold relative z-10">
                        <span class="font-extrabold text-indigo-700">Informasi Penting:</span> Demi menjaga keamanan transaksi dan keaslian karya, akun <span class="font-extrabold text-indigo-700">Mitra Fotografer</span> memerlukan proses <span class="font-extrabold text-indigo-700">verifikasi identitas</span>. Mohon unggah <span class="font-extrabold text-indigo-700">foto KTP</span> Anda yang valid dan terbaca jelas sebelum mulai mempublikasikan karya foto.
                    </p>
                </div>

                {{-- Upload KTP --}}
                <div class="space-y-1.5">
                    <label class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Unggah KTP</label>
                    <div class="clean-glass-box rounded-2xl p-5 transition-all shadow-sm shadow-slate-200/50 space-y-4">
                        
                        {{-- Preview Area --}}
                        <div id="ktp_preview_container" class="relative w-full h-40 rounded-xl border border-dashed border-slate-350 bg-white/30 flex flex-col items-center justify-center overflow-hidden group/preview transition-all">
                            <img id="ktp_preview_image" src="" alt="Pratinjau KTP" class="hidden w-full h-full object-cover">
                            <div id="ktp_placeholder" class="flex flex-col items-center gap-1.5 text-slate-450 text-center px-4">
                                <svg class="w-9 h-9 text-sky-600 group-hover/preview:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="16" rx="2" />
                                    <circle cx="9" cy="10" r="2" />
                                    <path d="M5 16s1-2 4-2 4 2 4 2" />
                                    <line x1="14" y1="9" x2="19" y2="9" />
                                    <line x1="14" y1="13" x2="19" y2="13" />
                                </svg>
                                <p class="text-[10px] font-black uppercase tracking-wider text-slate-600">Belum Ada Berkas Terpilih</p>
                                <p class="text-[9px] font-semibold text-slate-450/70">Pratinjau KTP Anda akan muncul di sini</p>
                            </div>
                        </div>

                        <input type="file" name="ktp_photo" id="ktp_input" accept="image/png,image/jpeg,image/jpg"
                            class="block w-full text-xs font-bold text-slate-700 file:mr-4 file:rounded-xl file:border-0 file:bg-gradient-to-r file:from-sky-500/80 file:to-indigo-600/80 file:px-4 file:py-2 file:text-[10px] file:font-black file:text-white hover:file:from-sky-500 hover:file:to-indigo-600 file:shadow-md file:cursor-pointer"
                            onchange="previewKTP(event)">
                        <p class="text-[10px] text-slate-500/80 font-bold">Format JPG/PNG, maksimum 5 MB.</p>
                    </div>
                </div>

                <div class="px-1">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" required class="w-3.5 h-3.5 rounded border-slate-300 bg-white/50 text-indigo-500 focus:ring-indigo-100 cursor-pointer">
                        <span class="text-[10px] font-bold text-slate-600 group-hover:text-slate-700 transition-colors">Saya menyetujui Syarat & Ketentuan serta Kebijakan Privasi KeJepret.</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-4 bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-md shadow-slate-300/40 hover:shadow-lg hover:shadow-slate-300/60 hover:-translate-y-0.5 active:translate-y-0 transition-all cursor-pointer flex items-center justify-center gap-2 mt-1">
                    DAFTAR SEBAGAI FOTOGRAFER
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>

                {{-- Sekat Pembatas / Divider --}}
                <div class="relative flex py-2 items-center">
                    <div class="flex-grow border-t border-slate-200/60"></div>
                    <span class="flex-shrink mx-4 text-[9px] font-black text-slate-400/80 uppercase tracking-[0.2em]">Atau Pilih Lainnya</span>
                    <div class="flex-grow border-t border-slate-200/60"></div>
                </div>

                {{-- Tombol Daftar Pelari / Masuk rounded-full --}}
                <div class="grid grid-cols-2 gap-4">
                    {{-- Tombol Pelari --}}
                    <a href="{{ route('register') }}" class="flex items-center justify-center gap-2 py-3.5 bg-white/40 hover:bg-white/75 border border-sky-400/70 hover:border-sky-500 text-sky-600 hover:text-sky-700 rounded-full font-black text-[10px] uppercase tracking-widest transition-all shadow-sm shadow-slate-200/40 hover:shadow active:scale-[0.98] cursor-pointer">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="16" cy="4" r="1" fill="currentColor" />
                            <path d="m12 8-2.5-1.5L6 10" />
                            <path d="M11.5 7.5 14 9.5l3.5-1.5" />
                            <path d="m9.5 13 .5 3.5 2.5 2" />
                            <path d="M12.5 11.5 11 15.5l-3.5 3.5" />
                        </svg>
                        Pelari
                    </a>
                    {{-- Tombol Masuk --}}
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 py-3.5 bg-white/40 hover:bg-white/75 border border-slate-300 hover:border-slate-400 text-slate-600 hover:text-slate-700 rounded-full font-black text-[10px] uppercase tracking-widest transition-all shadow-sm shadow-slate-200/40 hover:shadow active:scale-[0.98] cursor-pointer">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg>
                        Masuk
                    </a>
                </div>
            </form>
        </div>

        <p class="text-center text-[10px] font-bold text-slate-500 uppercase tracking-[0.3em] relative z-10">
            &copy; 2026 KEJEPRET STUDIO
        </p>
    </div>

    <script>
        function togglePassword(inputId, eyeOpenId, eyeCloseId) {
            const input = document.getElementById(inputId);
            const eyeOpen = document.getElementById(eyeOpenId);
            const eyeClose = document.getElementById(eyeCloseId);
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClose.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClose.classList.add('hidden');
            }
        }

        function previewKTP(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function(){
                const dataURL = reader.result;
                const image = document.getElementById('ktp_preview_image');
                const placeholder = document.getElementById('ktp_placeholder');
                const container = document.getElementById('ktp_preview_container');
                
                image.src = dataURL;
                image.classList.remove('hidden');
                placeholder.classList.add('hidden');
                container.classList.remove('border-dashed');
                container.classList.add('border-solid');
            };
            if(input.files && input.files[0]){
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
