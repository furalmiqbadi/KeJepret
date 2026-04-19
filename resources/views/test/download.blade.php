<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Download</title>
    <style>body{font-family:sans-serif;max-width:800px;margin:40px auto;padding:0 20px}h2{background:#333;color:#fff;padding:10px}form{border:1px solid #ccc;padding:20px;margin-bottom:30px}input{display:block;width:100%;margin:8px 0;padding:8px;box-sizing:border-box}button{background:#4CAF50;color:#fff;padding:10px 20px;border:none;cursor:pointer}a{display:inline-block;margin:5px;color:blue}</style>
</head>
<body>
<h1>🧪 TEST DOWNLOAD</h1>
<p>Login sebagai: <strong>{{ auth()->user()->name ?? 'Belum login' }}</strong></p>

<h2>DOWNLOAD FOTO VIA TOKEN</h2>
<p>Token didapat dari <code>order_items.download_token</code> setelah order berstatus <strong>paid</strong>.</p>
<form method="GET" action="#">
    <input type="text" id="dl_token" placeholder="Masukkan download_token dari order_items" value="">
    <a href="#" onclick="window.location='/runner/download/'+document.getElementById('dl_token').value">
        <button type="button">⬇️ Download Foto</button>
    </a>
</form>

<h2>Cara Test:</h2>
<ol>
    <li>Login sebagai runner</li>
    <li>Tambah foto ke cart → checkout → bayar</li>
    <li>Cek DB tabel <code>order_items</code> → ambil nilai kolom <code>download_token</code></li>
    <li>Paste token di form atas → klik Download</li>
    <li>Browser harusnya langsung download foto original</li>
</ol>

@if(session('success'))<p style="color:green">✅ {{ session('success') }}</p>@endif
@if(session('error'))<p style="color:red">❌ {{ session('error') }}</p>@endif

<hr>
<a href="{{ route('test.admin') }}">← Test Admin</a>
<a href="{{ route('test.auth') }}">↩ Mulai Lagi dari Auth</a>
</body>
</html>
