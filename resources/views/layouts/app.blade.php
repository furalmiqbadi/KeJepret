<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KeJepret') — KeJepret</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,800&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
        }
        body {
            font-family: var(--font-sans);
            -webkit-font-smoothing: antialiased;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">

    {{-- Top Navbar --}}
    @if(!isset($hideNav))
        @include('partials.navbar')
    @endif

    {{-- Main Content --}}
    <main class="{{ isset($hideNav) ? 'pt-0 pb-0' : 'pt-20 pb-24 md:pb-8' }}">
        @yield('content')
    </main>

    {{-- Bottom Navigation (Mobile) --}}
    @if(!isset($hideNav))
        @include('partials.bottom-nav')
    @endif

</body>
</html>