<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KeJepret')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS v4 CDN (No Node.js Required) -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
            --color-blue-600: #2563eb;
            --color-blue-700: #1d4ed8;
        }
        
        body {
            font-family: var(--font-sans);
            -webkit-font-smoothing: antialiased;
        }

        /* Custom utility for glassmorphism if needed */
        .glass {
            @apply bg-white/80 backdrop-blur-md;
        }
    </style>
</head>
<body class="bg-gray-50 text-slate-900 min-h-screen">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar (Desktop) -->
        @include('partials.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 md:ml-64 transition-all duration-300">
            <!-- Mobile Header -->
            <header class="md:hidden bg-white border-b border-gray-100 p-4 flex items-center justify-between sticky top-0 z-40">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                <span class="text-lg font-black text-gray-900 uppercase italic tracking-tighter text-blue-600">KeJepret</span>
            </a>
                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
            </header>

            <main class="p-4 md:p-8 lg:p-12 pb-24 md:pb-8 max-w-7xl mx-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bottom Navigation (Mobile) -->
    @include('partials.bottom-nav')
</body>
</html>
