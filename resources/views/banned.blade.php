<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Diblokir – KeJepret</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
        }
        body { font-family: var(--font-sans); }
    </style>
</head>
<body class="min-h-screen bg-slate-100 flex items-center justify-center p-6">
    <div class="w-full max-w-xl bg-white border border-slate-200 rounded-3xl shadow-xl p-10 text-center space-y-6">
        <div class="mx-auto w-20 h-20 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-4xl font-bold">
            !
        </div>

        <div class="space-y-2">
            <h1 class="text-3xl font-black text-slate-900">Akun Telah Diblokir</h1>
            <p class="text-slate-500 font-medium">
                Akun photographer kamu saat ini diblokir oleh admin dan tidak dapat mengakses fitur photographer.
            </p>
        </div>

        <div class="bg-red-50 border border-red-100 rounded-2xl p-5 text-left">
            <p class="text-xs font-black uppercase tracking-[0.2em] text-red-500 mb-2">Alasan Banned</p>
            <p class="text-sm font-semibold text-slate-700">
                {{ session('banned_reason') ?? optional(auth()->user())->banned_reason ?? 'Tidak ada keterangan.' }}
            </p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full py-4 rounded-2xl bg-slate-900 text-white font-black uppercase tracking-[0.12em] hover:bg-slate-800 transition">
                Logout
            </button>
        </form>
    </div>
</body>
</html>
