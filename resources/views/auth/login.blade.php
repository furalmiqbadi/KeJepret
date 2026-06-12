<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk – KeJepret</title>

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

    <div class="w-full max-w-md space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-1000 relative z-10">

        {{-- Login Card --}}
        <div class="clean-glass p-10 rounded-[2.5rem] space-y-6 relative overflow-hidden">

            {{-- Logo & Judul --}}
            <div class="flex flex-col items-center gap-3.5 text-center relative z-10">
                <a href="/" class="group block">
                    <h1 class="text-4xl font-extrabold tracking-tighter bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-600 bg-clip-text text-transparent drop-shadow-sm transition-transform duration-500 group-hover:scale-105">
                        KeJepret
                    </h1>
                </a>
                <div>
                    <h2 class="text-lg font-black text-slate-800 tracking-tight">Selamat Datang Kembali</h2>
                    <p class="text-slate-500 font-semibold text-xs mt-1">Masuk untuk melihat momen terbaik Anda.</p>
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

            @if (session('status'))
                <div class="flex items-center gap-3 clean-glass-box text-slate-700 rounded-2xl px-5 py-4">
                    <svg class="w-5 h-5 shrink-0 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <p class="text-xs font-semibold">{{ session('status') }}</p>
                </div>
            @endif

            <form action="{{ route('login.post', [], false) }}" method="POST" class="space-y-5 relative z-10">
                @csrf

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

                {{-- Password / Kata Sandi --}}
                <div class="space-y-1.5">
                    <label class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Kata Sandi</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-sky-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password_login" placeholder="••••••••"
                            class="w-full clean-glass-input rounded-2xl pl-11 pr-12 py-3.5 text-xs font-semibold text-slate-800 outline-none placeholder:text-slate-400/70 shadow-sm shadow-slate-200/50">
                        <button type="button" onclick="togglePassword('password_login', 'eye_login_open', 'eye_login_close')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 cursor-pointer transition-colors flex items-center justify-center z-10">
                            <svg id="eye_login_open" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eye_login_close" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between px-1">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="remember" class="w-3.5 h-3.5 rounded border-slate-300 bg-white/50 text-sky-500 focus:ring-sky-100 cursor-pointer">
                        <label for="remember" class="text-[10px] font-semibold text-slate-600 cursor-pointer select-none">Ingat saya</label>
                    </div>
                </div>

                {{-- Tombol Masuk --}}
                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-md shadow-slate-300/40 hover:shadow-lg hover:shadow-slate-300/60 hover:-translate-y-0.5 active:translate-y-0 transition-all cursor-pointer flex items-center justify-center gap-2 mt-1">
                    Masuk
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>

                {{-- Sekat Pembatas / Divider --}}
                <div class="relative flex py-2 items-center">
                    <div class="flex-grow border-t border-slate-200/60"></div>
                    <span class="flex-shrink mx-4 text-[9px] font-black text-slate-400/80 uppercase tracking-[0.2em]">Atau Daftar Akun</span>
                    <div class="flex-grow border-t border-slate-200/60"></div>
                </div>

                {{-- Tombol Daftar Pelari / Fotografer rounded-full --}}
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
                    {{-- Tombol Fotografer --}}
                    <a href="{{ route('register.photographer') }}" class="flex items-center justify-center gap-2 py-3.5 bg-white/40 hover:bg-white/75 border border-purple-400/70 hover:border-purple-500 text-purple-600 hover:text-purple-700 rounded-full font-black text-[10px] uppercase tracking-widest transition-all shadow-sm shadow-slate-200/40 hover:shadow active:scale-[0.98] cursor-pointer">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z" />
                            <circle cx="12" cy="13" r="3" />
                        </svg>
                        Fotografer
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
    </script>
</body>
</html>
