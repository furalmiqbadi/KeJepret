<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KeJepret') — KeJepret</title>

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
        body {
            font-family: var(--font-sans);
            -webkit-font-smoothing: antialiased;
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
        .glass-card {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(32px) saturate(140%);
            -webkit-backdrop-filter: blur(32px) saturate(140%);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 30px 60px -15px rgba(15, 23, 42, 0.05), 0 0 0 1px rgba(255, 255, 255, 0.6) inset;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.85);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 40px 80px -15px rgba(99, 102, 241, 0.12), 0 0 0 1px rgba(255, 255, 255, 0.8) inset;
        }
        .glass-input {
            background: rgba(248, 250, 252, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(15, 23, 42, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #1e293b;
            outline: none;
        }
        .glass-input::placeholder {
            color: #94a3b8;
        }
        .glass-input:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
        }
        .glass-btn-blue {
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-btn-blue:hover {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 50%, #4f46e5 100%);
            box-shadow: 0 20px 40px -10px rgba(59, 130, 246, 0.4);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="bg-[#eef2f6] text-gray-900 min-h-screen relative">

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

    {{-- Top Navbar --}}
    @if(!isset($hideNav))
        @include('partials.navbar')
    @endif

    {{-- Main Content --}}
    <main class="relative z-10 {{ isset($hideNav) ? 'pt-0 pb-0' : 'pt-20 pb-24 md:pb-8' }}">
        @yield('content')
    </main>

    {{-- Bottom Navigation (Mobile) --}}
    @if(!isset($hideNav))
        @include('partials.bottom-nav')
    @endif

</body>
</html>