<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk – KeJepret</title>

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
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: #1e293b;
        }
        .liquid-blob-1 {
            animation: float-1 25s ease-in-out infinite;
        }
        .liquid-blob-2 {
            animation: float-2 20s ease-in-out infinite;
        }
        .liquid-blob-3 {
            animation: float-3 15s ease-in-out infinite;
        }
        @keyframes float-1 {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(40px, -60px) scale(1.15); }
            66% { transform: translate(-30px, 30px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        @keyframes float-2 {
            0% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(-40px, 50px) scale(1.1); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        @keyframes float-3 {
            0% { transform: translate(0px, 0px) scale(1); }
            50% { transform: translate(50px, -30px) scale(1.2); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center p-6 relative overflow-x-hidden">
    {{-- Background Liquid Blobs --}}
    <div class="absolute inset-0 pointer-events-none z-0">
        <div class="absolute top-[10%] left-[5%] w-[400px] h-[400px] bg-gradient-to-tr from-sky-400/30 to-blue-400/20 rounded-full blur-[80px] liquid-blob-1"></div>
        <div class="absolute bottom-[15%] right-[5%] w-[500px] h-[500px] bg-gradient-to-br from-indigo-400/25 to-purple-400/25 rounded-full blur-[100px] liquid-blob-2"></div>
        <div class="absolute top-[40%] right-[20%] w-[300px] h-[300px] bg-gradient-to-tr from-pink-400/20 to-rose-400/15 rounded-full blur-[70px] liquid-blob-3"></div>
    </div>

    <div class="w-full max-w-md space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-1000 relative z-10">

        {{-- Logo --}}
        <div class="flex flex-col items-center gap-4">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-14 h-14 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-blue-500/20 group-hover:scale-110 transition-transform duration-500">
                    <span class="material-symbols-outlined text-[32px]">camera_enhance</span>
                </div>
                <h1 class="text-3xl font-black tracking-tighter uppercase italic bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-800">KeJepret</h1>
            </a>
            <div class="text-center">
                <h2 class="text-2xl font-black text-slate-950 tracking-tight">Selamat Datang!</h2>
                <p class="text-slate-500 font-semibold text-sm mt-1">Masuk untuk melihat momen terbaikmu.</p>
            </div>
        </div>

        {{-- Glassmorphism Card --}}
        <div class="backdrop-blur-3xl bg-white/45 p-10 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.06)] border border-white/40 space-y-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-12 opacity-[0.04] pointer-events-none transform translate-x-4 -translate-y-4">
                <span class="material-symbols-outlined text-[150px] text-slate-800">key</span>
            </div>

            @if ($errors->any())
                <div class="flex items-start gap-3 bg-red-500/10 backdrop-blur-md border border-red-500/20 text-red-700 rounded-2xl px-5 py-4">
                    <span class="material-symbols-outlined text-[20px] mt-0.5 shrink-0">error</span>
                    <ul class="text-xs font-bold space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="flex items-center gap-3 bg-green-500/10 backdrop-blur-md border border-green-500/20 text-green-700 rounded-2xl px-5 py-4">
                    <span class="material-symbols-outlined text-[20px] shrink-0">check_circle</span>
                    <p class="text-xs font-bold">{{ session('status') }}</p>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6 relative z-10">
                @csrf

                {{-- Email --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Alamat Email</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-600 transition-colors">alternate_email</span>
                        <input type="email" name="email" placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            class="w-full bg-white/40 backdrop-blur-md border border-white/40 rounded-2xl pl-12 pr-4 py-4 text-sm font-bold text-slate-900 outline-none focus:bg-white/70 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all placeholder-slate-400 shadow-inner">
                    </div>
                </div>

                {{-- Password + Toggle --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] ml-2">Kata Sandi</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-600 transition-colors">lock</span>
                        <input type="password" name="password" id="password_login" placeholder="••••••••"
                            class="w-full bg-white/40 backdrop-blur-md border border-white/40 rounded-2xl pl-12 pr-12 py-4 text-sm font-bold text-slate-900 outline-none focus:bg-white/70 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all placeholder-slate-400 shadow-inner">
                        <button type="button" onclick="togglePassword('password_login', 'eye_login')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-600 transition-colors">
                            <span class="material-symbols-outlined text-[20px]" id="eye_login">visibility</span>
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-2 px-1">
                    <input type="checkbox" id="remember" class="w-3.5 h-3.5 rounded border-white/40 bg-white/20 text-blue-600 focus:ring-blue-100 cursor-pointer">
                    <label for="remember" class="text-[11px] font-bold text-slate-600 cursor-pointer select-none">Tetap masuk</label>
                </div>

                <button type="submit" class="w-full py-4 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-600/25 hover:shadow-xl hover:shadow-blue-600/40 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2 mt-2">
                    Masuk Sekarang
                    <span class="material-symbols-outlined text-sm font-bold">login</span>
                </button>
            </form>

            <div class="text-center pt-2 space-y-3">
                <p class="text-sm font-semibold text-slate-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar Gratis</a>
                </p>
                <p class="text-sm font-semibold text-slate-500">
                    Kamu fotografer?
                    <a href="{{ route('register.photographer') }}" class="text-blue-600 font-bold hover:underline">Daftar di Sini</a>
                </p>
            </div>
        </div>

        <p class="text-center text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">
            &copy; 2026 KEJEPRET STUDIO &bull; PREMIUM ACCESS
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
