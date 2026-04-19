<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Photo</title>
    <style>body{font-family:sans-serif;max-width:800px;margin:40px auto;padding:0 20px}h2{background:#333;color:#fff;padding:10px}form{border:1px solid #ccc;padding:20px;margin-bottom:30px}input,select{display:block;width:100%;margin:8px 0;padding:8px;box-sizing:border-box}button{background:#4CAF50;color:#fff;padding:10px 20px;border:none;cursor:pointer}a{display:inline-block;margin:5px;color:blue}</style>
</head>
<body>
<h1>🧪 TEST PHOTO</h1>
<p>Login sebagai: <strong>{{ auth()->user()->name ?? 'Belum login' }}</strong> | Role: <strong>{{ auth()->user()->role ?? '-' }}</strong></p>

<h2>LIST FOTO MILIK FOTOGRAFER</h2>
<a href="{{ route('photographer.photos') }}"><button>Lihat Semua Foto Saya</button></a>

<h2>UPLOAD FOTO</h2>
<form method="POST" action="{{ route('photographer.photos.upload.post') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="photos[]" multiple accept="image/*" required>
    <input type="number" name="event_id" placeholder="Event ID (opsional)">
    <input type="number" name="price" placeholder="Harga (min 5000)" value="25000" required>
    <input type="text" name="category" placeholder="Kategori (opsional)" value="lari">
    <button type="submit">Upload Foto</button>
</form>

<h2>UPDATE HARGA FOTO</h2>
<form method="POST" action="{{ route('photographer.photos.price.post', ['id' => 1]) }}">
    @csrf
    @method('PUT')
    <p>Update harga Photo ID = 1</p>
    <input type="number" name="price" placeholder="Harga baru (min 5000)" value="30000" required>
    <button type="submit">Update Harga</button>
</form>

@if(session('success'))<p style="color:green">✅ {{ session('success') }}</p>@endif
@if(session('error'))<p style="color:red">❌ {{ session('error') }}</p>@endif
@if($errors->any())<ul style="color:red">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>@endif

<hr>
<a href="{{ route('test.auth') }}">← Test Auth</a>
<a href="{{ route('test.search') }}">→ Test Search</a>
</body>
</html>
