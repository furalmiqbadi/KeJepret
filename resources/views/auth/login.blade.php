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
            background-color: #fafafa;
            color: #1e293b;
        }

        .grid-pattern {
            position: fixed;
            inset: 0;
            background-image: 
                linear-gradient(to right, rgba(0, 0, 0, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 0, 0, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
            z-index: -1;
        }

        .glass {
            @apply bg-white/60 backdrop-blur-xl border border-white/20 shadow-sm;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex items-center justify-center p-6">
    <div class="grid-pattern"></div>

    <div class="w-full max-w-md space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-1000">
        <!-- Logo -->
        <div class="flex flex-col items-center gap-4">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-14 h-14 bg-blue-600 rounded-[1.25rem] flex items-center justify-center text-white shadow-2xl shadow-blue-500/40 group-hover:scale-110 transition-transform duration-500">
                    <span class="material-symbols-outlined text-[32px]">camera_enhance</span>
                </div>
                <h1 class="text-3xl font-black tracking-tighter uppercase italic">KeJepret</h1>
            </a>
            <div class="text-center">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Selamat Datang!</h2>
                <p class="text-slate-500 font-medium text-sm mt-1">Masuk untuk melihat momen terbaikmu.</p>
            </div>
        </div>

        <!-- Login Card -->
        <div class="bg-white p-10 rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-slate-100 space-y-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-12 opacity-[0.03] pointer-events-none transform translate-x-4 -translate-y-4">
                <span class="material-symbols-outlined text-[150px]">key</span>
            </div>

            {{-- Global Error --}}
            @if ($errors->any())
                <div class="flex items-start gap-3 bg-red-50 border border-red-100 text-red-600 rounded-2xl px-5 py-4">
                    <span class="material-symbols-outlined text-[20px] mt-0.5 shrink-0">error</span>
                    <ul class="text-xs font-bold space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Session Status --}}
            @if (session('status'))
                <div class="flex items-center gap-3 bg-green-50 border border-green-100 text-green-600 rounded-2xl px-5 py-4">
                    <span class="material-symbols-outlined text-[20px] shrink-0">check_circle</span>
                    <p class="text-xs font-bold">{{ session('status') }}</p>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6 relative z-10">
                @csrf
                
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Alamat Email</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-600 transition-colors">alternate_email</span>
                        <input type="email" name="email" placeholder="nama@email.com"
                            value="{{ old('email') }}"
                            class="w-full bg-slate-50 border {{ $errors->has('email') ? 'border-red-300' : 'border-slate-100' }} rounded-2xl pl-12 pr-4 py-4 text-sm font-bold text-slate-900 outline-none focus:ring-4 focus:ring-blue-100 transition-all">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Kata Sandi</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-blue-600 transition-colors">lock</span>
                        <input type="password" name="password" placeholder="••••••••"
                            class="w-full bg-slate-50 border {{ $errors->has('password') ? 'border-red-300' : 'border-slate-100' }} rounded-2xl pl-12 pr-4 py-4 text-sm font-bold text-slate-900 outline-none focus:ring-4 focus:ring-blue-100 transition-all">
                    </div>
                </div>

                <div class="flex items-center justify-between px-2">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" class="w-4 h-4 rounded border-slate-200 text-blue-600 focus:ring-blue-500">
                        <span class="text-xs font-bold text-slate-500 group-hover:text-slate-900 transition-colors">Ingat Saya</span>
                    </label>
                    <a href="#" class="text-xs font-black text-blue-600 uppercase tracking-widest italic hover:underline">Lupa Sandi?</a>
                </div>

                <button type="submit" class="w-full py-5 bg-blue-600 text-white rounded-[1.5rem] font-black text-sm uppercase italic tracking-[0.1em] shadow-xl shadow-blue-500/25 hover:bg-blue-700 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2 mt-8">
                    Masuk Sekarang
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </form>

            <div class="text-center pt-2 space-y-2">
                <p class="text-sm font-medium text-slate-400">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-blue-600 font-black uppercase italic tracking-tighter hover:underline">Daftar Gratis</a>
                </p>
                <p class="text-sm font-medium text-slate-400">
                    Kamu fotografer? 
                    <a href="{{ route('register.photographer') }}" class="text-blue-600 font-black uppercase italic tracking-tighter hover:underline">Daftar di Sini</a>
                </p>
            </div>
        </div>

        <p class="text-center text-[10px] font-bold text-slate-300 uppercase tracking-[0.3em]">
            &copy; 2026 KEJEPRET STUDIO &bull; PREMIUM ACCESS
        </p>
    </div>
</body>
</html>
