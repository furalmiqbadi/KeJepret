<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Search</title>
    <style>body{font-family:sans-serif;max-width:800px;margin:40px auto;padding:0 20px}h2{background:#333;color:#fff;padding:10px}form{border:1px solid #ccc;padding:20px;margin-bottom:30px}input{display:block;width:100%;margin:8px 0;padding:8px;box-sizing:border-box}button{background:#4CAF50;color:#fff;padding:10px 20px;border:none;cursor:pointer}a{display:inline-block;margin:5px;color:blue}</style>
</head>
<body>
<h1>🧪 TEST SEARCH (AI Face)</h1>
<p>Login sebagai: <strong>{{ auth()->user()->name ?? 'Belum login' }}</strong> | Role: <strong>{{ auth()->user()->role ?? '-' }}</strong></p>

<h2>ENROLL WAJAH</h2>
<form method="POST" action="{{ route('runner.enroll.post') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="selfie" accept="image/*" required>
    <button type="submit">Daftarkan Wajah (Enroll)</button>
</form>

<h2>SEARCH BY SELFIE</h2>
<form method="POST" action="{{ route('runner.search.post') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="selfie" accept="image/*" required>
    <input type="number" name="event_id" placeholder="Event ID (opsional)">
    <button type="submit">🔍 Cari Foto Saya</button>
</form>

<h2>HISTORY SEARCH</h2>
<a href="{{ route('runner.search.history') }}"><button>Lihat History Search</button></a>

@if(session('success'))<p style="color:green">✅ {{ session('success') }}</p>@endif
@if(session('error'))<p style="color:red">❌ {{ session('error') }}</p>@endif
@if(session('info'))<p style="color:orange">ℹ️ {{ session('info') }}</p>@endif
@if($errors->any())<ul style="color:red">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>@endif

<hr>
<a href="{{ route('test.photo') }}">← Test Photo</a>
<a href="{{ route('test.balance') }}">→ Test Balance</a>
</body>
</html>
