<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KeJepret')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600&family=Exo+2:ital,wght@0,700;0,800;0,900;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet">

    <!-- Tailwind CSS v4 CDN (No Node.js Required) -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
            --font-exo: 'Exo 2', sans-serif;
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

        /* Sidebar Minimize Styles (Smooth Sweep & Static Icons) */
        .sidebar-text, 
        .logo-text, 
        .sidebar-label {
            @apply transition-all duration-500 ease-in-out opacity-100 translate-x-0;
            display: inline-block;
            white-space: nowrap;
        }

        /* Saat Minimize: Efek sapuan harus lebih cepat agar tidak terpotong */
        .sidebar-minimized .sidebar-text,
        .sidebar-minimized .logo-text,
        .sidebar-minimized .sidebar-label {
            @apply opacity-0 -translate-x-4 pointer-events-none;
            transition-duration: 200ms;
            width: 0;
            margin-right: 0;
            margin-left: 0;
        }

        .sidebar-label {
            @apply font-exo italic;
        }

        .logo-text {
            @apply font-exo italic;
        }

        aside {
            @apply transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)];
        }

        .sidebar-minimized aside {
            @apply w-20;
        }

        #main-content {
            @apply transition-all duration-700 ease-[cubic-bezier(0.4,0,0.2,1)];
        }

        .sidebar-minimized #main-content {
            @apply md:ml-20;
        }

        /* Ikon harus tetap di kiri agar tidak bergerak saat sidebar menyusut */
        .sidebar-item {
            @apply justify-start;
        }

        /* Tooltip Styles for Minimized Sidebar */
        .sidebar-tooltip {
            @apply hidden absolute left-full ml-4 px-3 py-2 bg-slate-900 text-white text-xs font-bold rounded-lg whitespace-nowrap shadow-xl z-[60] pointer-events-none;
        }

        .sidebar-minimized .sidebar-item:hover .sidebar-tooltip {
            @apply block;
        }

        .sidebar-minimized .sidebar-item:hover .sidebar-tooltip::before {
            content: '';
            @apply absolute right-full top-1/2 -translate-y-1/2 border-[6px] border-transparent border-r-slate-900;
        }
    </style>
</head>

<body class="bg-gray-50 text-slate-900 min-h-screen">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar (Desktop) -->
        @include('partials.sidebar')

        <!-- Main Content Area -->
        <div id="main-content" class="flex-1 md:ml-64 transition-all duration-300">
            <!-- Mobile Header -->
            <header
                class="md:hidden bg-white border-b border-gray-100 p-4 flex items-center justify-between sticky top-0 z-40">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                    <span
                        class="text-xl font-black text-gray-900 uppercase italic tracking-tighter logo-text">KeJepret</span>
                </a>
                <a href="{{ route('profil') }}" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>
            </header>

            <main class="p-4 md:p-8 lg:p-12 pb-24 md:pb-8 max-w-7xl mx-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bottom Navigation (Mobile) -->
    @include('partials.bottom-nav')

    <script>
        const body = document.body;

        // Load initial state
        if (localStorage.getItem('sidebar-minimized') === 'true') {
            body.classList.add('sidebar-minimized');
        }

        function toggleSidebar() {
            body.classList.toggle('sidebar-minimized');
            const isMinimized = body.classList.contains('sidebar-minimized');
            localStorage.setItem('sidebar-minimized', isMinimized);

            const icon = document.getElementById('toggle-icon');
            if (icon) {
                icon.innerText = isMinimized ? 'menu' : 'menu_open';
            }
        }

        // Apply icon on load
        if (localStorage.getItem('sidebar-minimized') === 'true') {
            const icon = document.getElementById('toggle-icon');
            if (icon) icon.innerText = 'menu';
        }
    </script>
</body>

</html>