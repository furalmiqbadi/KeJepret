<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Diblokir – KeJepret</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
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

    <div class="w-full max-w-lg space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-1000 relative z-10">

        <div class="clean-glass p-10 rounded-[2.5rem] space-y-6 relative overflow-hidden text-center">
            
            <div class="mx-auto w-20 h-20 rounded-3xl bg-red-500/10 text-red-600 flex items-center justify-center shadow-inner border border-red-500/20">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>

            <div class="space-y-2">
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Akun Telah Diblokir</h1>
                <p class="text-slate-500 font-semibold text-xs leading-relaxed max-w-sm mx-auto">
                    Akun fotografer kamu saat ini diblokir oleh administrator dan tidak dapat mengakses fitur fotografer.
                </p>
            </div>

            <div class="flex items-start gap-3 rounded-2xl px-5 py-4 border border-red-200/60 bg-red-50/40 backdrop-blur-md relative overflow-hidden text-left">
                <div class="absolute -right-4 -bottom-4 w-12 h-12 bg-red-200/20 rounded-full blur-xl"></div>
                <svg class="w-5 h-5 mt-0.5 shrink-0 text-red-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="16" x2="12" y2="12" />
                    <line x1="12" y1="8" x2="12.01" y2="8" />
                </svg>
                <div class="relative z-10">
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-red-500 mb-1">Alasan Penangguhan</p>
                    <p class="text-xs font-bold text-red-950/80 leading-relaxed">
                        {{ session('banned_reason') ?? optional(auth()->user())->banned_reason ?? 'Tidak ada keterangan khusus dari administrator.' }}
                    </p>
                </div>
            </div>

            <form action="{{ route('logout', [], false) }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-red-500 via-rose-500 to-red-600 hover:from-red-600 hover:to-rose-700 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-md shadow-red-300/40 hover:shadow-lg hover:shadow-red-300/60 hover:-translate-y-0.5 active:translate-y-0 transition-all cursor-pointer flex items-center justify-center gap-2">
                    Keluar dari Akun
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>

        <p class="text-center text-[10px] font-bold text-slate-500 uppercase tracking-[0.3em] relative z-10">
            &copy; 2026 KEJEPRET STUDIO
        </p>
    </div>
</body>
</html>
