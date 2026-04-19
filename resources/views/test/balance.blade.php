<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Balance</title>
    <style>body{font-family:sans-serif;max-width:800px;margin:40px auto;padding:0 20px}h2{background:#333;color:#fff;padding:10px}form{border:1px solid #ccc;padding:20px;margin-bottom:30px}input{display:block;width:100%;margin:8px 0;padding:8px;box-sizing:border-box}button{background:#4CAF50;color:#fff;padding:10px 20px;border:none;cursor:pointer}a{display:inline-block;margin:5px;color:blue}</style>
</head>
<body>
<h1>🧪 TEST BALANCE</h1>
<p>Login sebagai: <strong>{{ auth()->user()->name ?? 'Belum login' }}</strong> | Role: <strong>{{ auth()->user()->role ?? '-' }}</strong></p>

<h2>LIHAT SALDO</h2>
<a href="{{ route('balance.index') }}"><button>Lihat Saldo Saya</button></a>

<h2>RIWAYAT PENJUALAN</h2>
<a href="{{ route('balance.sales') }}"><button>Lihat Riwayat Sales</button></a>

<h2>AJUKAN WITHDRAW</h2>
<form method="POST" action="{{ route('balance.withdraw.post') }}">
    @csrf
    <input type="number" name="amount" placeholder="Jumlah withdraw (min 50000)" value="50000" required>
    <input type="text" name="bank_name" placeholder="Nama Bank" value="BCA" required>
    <input type="text" name="bank_account_number" placeholder="Nomor Rekening" value="1234567890" required>
    <input type="text" name="bank_account_name" placeholder="Nama Pemilik Rekening" value="Test Fotografer" required>
    <button type="submit">Ajukan Withdraw</button>
</form>

@if(session('success'))<p style="color:green">✅ {{ session('success') }}</p>@endif
@if(session('error'))<p style="color:red">❌ {{ session('error') }}</p>@endif
@if($errors->any())<ul style="color:red">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>@endif

<hr>
<a href="{{ route('test.search') }}">← Test Search</a>
<a href="{{ route('test.admin') }}">→ Test Admin</a>
</body>
</html>
