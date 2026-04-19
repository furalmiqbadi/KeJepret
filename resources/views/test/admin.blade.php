<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Admin</title>
    <style>body{font-family:sans-serif;max-width:900px;margin:40px auto;padding:0 20px}h2{background:#333;color:#fff;padding:10px}form{border:1px solid #ccc;padding:20px;margin-bottom:20px}input,textarea,select{display:block;width:100%;margin:8px 0;padding:8px;box-sizing:border-box}button{background:#4CAF50;color:#fff;padding:10px 20px;border:none;cursor:pointer;margin:4px}a{display:inline-block;margin:5px;color:blue}.danger{background:red}.warning{background:#FF9800}</style>
</head>
<body>
<h1>🧪 TEST ADMIN</h1>
<p>Login sebagai: <strong>{{ auth()->user()->name ?? 'Belum login' }}</strong> | Role: <strong>{{ auth()->user()->role ?? '-' }}</strong></p>

<h2>DASHBOARD ADMIN</h2>
<a href="{{ route('admin.dashboard') }}"><button>Lihat Dashboard Admin</button></a>

<h2>FOTOGRAFER PENDING VERIFIKASI</h2>
<a href="{{ route('admin.photographers.pending') }}"><button>Lihat Pending Fotografer</button></a>

<form method="POST" action="{{ route('admin.photographers.verify', ['id' => 1]) }}">
    @csrf
    <p>Verifikasi Fotografer User ID = 1</p>
    <button type="submit">✅ Verifikasi (ID=1)</button>
</form>

<form method="POST" action="{{ route('admin.photographers.reject', ['id' => 1]) }}">
    @csrf
    <p>Tolak Fotografer User ID = 1</p>
    <button type="submit" class="danger">❌ Tolak (ID=1)</button>
</form>

<h2>EVENTS</h2>
<a href="{{ route('admin.events.index') }}"><button>Lihat Semua Event</button></a>
<a href="{{ route('admin.events.create') }}"><button>Form Buat Event</button></a>

<form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Nama Event" value="Test Event Marathon 2026" required>
    <input type="date" name="event_date" value="2026-05-01" required>
    <input type="text" name="location" placeholder="Lokasi" value="Malang, Jawa Timur" required>
    <textarea name="description" placeholder="Deskripsi event">Event lari test</textarea>
    <input type="file" name="cover_image" accept="image/*">
    <button type="submit">Buat Event</button>
</form>

<form method="POST" action="{{ route('admin.events.update', ['id' => 1]) }}">
    @csrf
    @method('PUT')
    <p>Update Event ID = 1</p>
    <input type="text" name="name" placeholder="Nama baru" value="Event Updated">
    <input type="date" name="event_date" value="2026-06-01">
    <input type="text" name="location" placeholder="Lokasi baru" value="Surabaya">
    <select name="is_active"><option value="1">Aktif</option><option value="0">Nonaktif</option></select>
    <button type="submit" class="warning">Update Event (ID=1)</button>
</form>

<h2>WITHDRAWALS PENDING</h2>
<a href="{{ route('admin.withdrawals.pending') }}"><button>Lihat Pending Withdrawals</button></a>

<form method="POST" action="{{ route('admin.withdrawals.approve', ['id' => 1]) }}">
    @csrf
    <p>Approve Withdrawal ID = 1</p>
    <button type="submit">✅ Approve Withdrawal (ID=1)</button>
</form>

<form method="POST" action="{{ route('admin.withdrawals.reject', ['id' => 1]) }}">
    @csrf
    <textarea name="rejection_reason" placeholder="Alasan penolakan" required>Rekening tidak valid</textarea>
    <button type="submit" class="danger">❌ Reject Withdrawal (ID=1)</button>
</form>

<h2>NONAKTIFKAN FOTO</h2>
<form method="POST" action="{{ route('admin.photos.deactivate', ['id' => 1]) }}">
    @csrf
    @method('PUT')
    <p>Nonaktifkan Photo ID = 1</p>
    <button type="submit" class="danger">Nonaktifkan Foto (ID=1)</button>
</form>

@if(session('success'))<p style="color:green">✅ {{ session('success') }}</p>@endif
@if(session('error'))<p style="color:red">❌ {{ session('error') }}</p>@endif
@if($errors->any())<ul style="color:red">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>@endif

<hr>
<a href="{{ route('test.balance') }}">← Test Balance</a>
<a href="{{ route('test.download') }}">→ Test Download</a>
</body>
</html>
