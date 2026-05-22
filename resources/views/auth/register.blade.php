<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar – KeJepret</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            --color-sky-500: #0ea5e9;
            --color-sky-600: #0284c7;
        }
        html, body {
            font-family: var(--font-sans);
            background-color: #f8fafc;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%) fixed;
            color: #0f172a;
            min-height: 100vh;
        }
        .clean-glass {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(32px) saturate(160%);
            -webkit-backdrop-filter: blur(32px) saturate(160%);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(255, 255, 255, 0.5) inset;
        }
        .clean-glass-input {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px) saturate(120%);
            -webkit-backdrop-filter: blur(12px) saturate(120%);
            border: 1px solid rgba(15, 23, 42, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #1e293b;
        }
        .clean-glass-input::placeholder {
            color: #94a3b8;
        }
        .clean-glass-input:focus {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(14, 165, 233, 0.4);
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.15);
        }
        .clean-glass-box {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(15, 23, 42, 0.06);
            color: #334155;
        }
        .animate-float-slow {
            animation: float 12s ease-in-out infinite alternate;
        }
        .animate-float-reverse {
            animation: float-rev 15s ease-in-out infinite alternate;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 600, 'GRAD' 0, 'opsz' 24;
        }
        @keyframes float {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-20px) scale(1.05); }
        }
        @keyframes float-rev {
            0% { transform: translateY(0) scale(1.05); }
            100% { transform: translateY(20px) scale(0.95); }
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center py-12 px-6 relative select-none">

    <!-- Floating Background Orbs for Ultra-Premium Depth (Light Theme optimized - Fixed inset to prevent cutting on scroll) -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-[10%] -left-[10%] w-[60%] h-[60%] rounded-full bg-gradient-to-tr from-sky-400/8 to-indigo-400/8 blur-[150px] animate-float-slow"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[60%] h-[60%] rounded-full bg-gradient-to-br from-indigo-400/8 to-purple-400/8 blur-[150px] animate-float-reverse"></div>
    </div>

    <div class="w-full max-w-lg space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-1000 relative z-10">

        {{-- Register Card --}}
        <div class="clean-glass p-10 rounded-[2.5rem] space-y-6 relative overflow-hidden">
            {{-- Modern Ambient Decorative Glow inside Card --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-sky-400/4 rounded-full blur-3xl pointer-events-none"></div>

            {{-- Logo & Judul di dalam Card --}}
            <div class="flex flex-col items-center gap-3.5 text-center mb-2 relative z-10">
                <a href="/" class="group block">
                    <h1 class="text-4xl font-extrabold tracking-tighter bg-gradient-to-r from-sky-500 to-indigo-600 bg-clip-text text-transparent drop-shadow-sm transition-transform duration-500 group-hover:scale-105">
                        KeJepret
                    </h1>
                </a>
                <div>
                    <h2 class="text-lg font-black text-slate-800 tracking-tight">Buat Akun Baru</h2>
                    <p class="text-slate-500 font-semibold text-xs mt-1">Bergabunglah dengan ribuan pengguna lainnya.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="flex items-start gap-3 clean-glass-box text-slate-700 rounded-2xl px-5 py-4">
                    <span class="material-symbols-outlined text-[20px] mt-0.5 shrink-0 text-red-500">error_outline</span>
                    <ul class="text-xs font-semibold space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="space-y-5 relative z-10">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Nama --}}
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Nama Lengkap</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-sky-700 group-focus-within:text-sky-900 transition-colors text-[20px]">person</span>
                            <input type="text" name="name" placeholder="John Doe"
                                value="{{ old('name') }}"
                                class="w-full clean-glass-input rounded-2xl pl-11 pr-4 py-3.5 text-xs font-semibold text-slate-800 outline-none placeholder:text-slate-400 shadow-sm shadow-slate-200/50">
                        </div>
                    </div>

                    {{-- Email / Surel --}}
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Alamat Surel (Email)</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-sky-700 group-focus-within:text-sky-900 transition-colors text-[20px]">alternate_email</span>
                            <input type="email" name="email" placeholder="nama@email.com"
                                value="{{ old('email') }}"
                                class="w-full clean-glass-input rounded-2xl pl-11 pr-4 py-3.5 text-xs font-semibold text-slate-800 outline-none placeholder:text-slate-400 shadow-sm shadow-slate-200/50">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Password / Kata Sandi --}}
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Kata Sandi</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-sky-700 group-focus-within:text-sky-900 transition-colors text-[20px]">lock</span>
                            <input type="password" name="password" id="password_reg" placeholder="••••••••"
                                class="w-full clean-glass-input rounded-2xl pl-11 pr-11 py-3.5 text-xs font-semibold text-slate-800 outline-none placeholder:text-slate-400 shadow-sm shadow-slate-200/50">
                            <button type="button" onclick="togglePassword('password_reg', 'eye_reg')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-sky-700 hover:text-sky-900 transition-colors">
                                <span class="material-symbols-outlined text-[18px]" id="eye_reg">visibility</span>
                            </button>
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Konfirmasi Sandi</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-sky-700 group-focus-within:text-sky-900 transition-colors text-[20px]">verified_user</span>
                            <input type="password" name="password_confirmation" id="password_reg_confirm" placeholder="••••••••"
                                class="w-full clean-glass-input rounded-2xl pl-11 pr-11 py-3.5 text-xs font-semibold text-slate-800 outline-none placeholder:text-slate-400 shadow-sm shadow-slate-200/50">
                            <button type="button" onclick="togglePassword('password_reg_confirm', 'eye_reg_confirm')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-sky-700 hover:text-sky-900 transition-colors">
                                <span class="material-symbols-outlined text-[18px]" id="eye_reg_confirm">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- No. Telepon --}}
                <div class="space-y-1.5">
                    <label class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Nomor Telepon <span class="normal-case tracking-normal font-semibold text-slate-400/75">(opsional)</span></label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-sky-700 group-focus-within:text-sky-900 transition-colors text-[20px]">phone</span>
                        <input type="text" name="phone" placeholder="08xxxxxxxxxx"
                            value="{{ old('phone') }}"
                            class="w-full clean-glass-input rounded-2xl pl-11 pr-4 py-3.5 text-xs font-semibold text-slate-800 outline-none placeholder:text-slate-400 shadow-sm shadow-slate-200/50">
                    </div>
                </div>

                <div class="px-1">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox" required class="w-3.5 h-3.5 rounded border-slate-350 bg-white/50 text-sky-500 focus:ring-sky-100 cursor-pointer">
                        <span class="text-[10px] font-bold text-slate-600 group-hover:text-slate-700 transition-colors">Saya menyetujui Syarat & Ketentuan serta Kebijakan Privasi.</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-sky-500 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-lg shadow-indigo-500/10 hover:shadow-indigo-500/20 hover:-translate-y-0.5 active:translate-y-0 transition-all cursor-pointer flex items-center justify-center gap-2 mt-1">
                    Daftar
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </button>

                <div class="text-center">
                    <a href="{{ route('register.photographer') }}" class="text-[9px] font-black text-sky-500 hover:text-sky-600 transition-colors uppercase tracking-widest">Daftar sebagai fotografer &rarr;</a>
                </div>
            </form>

        </div>

        <p class="text-center text-[10px] font-bold text-slate-500 uppercase tracking-[0.3em] relative z-10">
            &copy; 2026 KEJEPRET STUDIO
        </p>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon  = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>
