<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Order</title>
    <style>body{font-family:sans-serif;max-width:800px;margin:40px auto;padding:0 20px}h2{background:#333;color:#fff;padding:10px}form{border:1px solid #ccc;padding:20px;margin-bottom:30px}input{display:block;width:100%;margin:8px 0;padding:8px;box-sizing:border-box}button{background:#4CAF50;color:#fff;padding:10px 20px;border:none;cursor:pointer}a{display:inline-block;margin:5px;color:blue}</style>
</head>
<body>
<h1>🧪 TEST ORDER</h1>
<p>Login sebagai: <strong>{{ auth()->user()->name ?? 'Belum login' }}</strong></p>

<h2>CHECKOUT (dari cart)</h2>
<form method="POST" action="{{ route('order.checkout') }}">
    @csrf
    <p>Akan checkout semua item di cart kamu</p>
    <button type="submit">Checkout Sekarang</button>
</form>

<h2>HISTORY ORDER</h2>
<a href="{{ route('order.history') }}"><button>Lihat History Order</button></a>

<h2>DETAIL ORDER</h2>
<form method="GET" action="#">
    <input type="number" id="order_id" placeholder="Order ID" value="1">
    <a href="#" onclick="window.location='/runner/orders/'+document.getElementById('order_id').value"><button type="button">Lihat Detail Order</button></a>
</form>

<h2>MANUAL PAY</h2>
<form method="POST" action="{{ route('order.pay', ['id' => 1]) }}">
    @csrf
    <p>Konfirmasi pembayaran Order ID = 1</p>
    <button type="submit" style="background:#FF9800">✅ Saya Sudah Bayar (Order ID=1)</button>
</form>

@if(session('success'))<p style="color:green">✅ {{ session('success') }}</p>@endif
@if(session('error'))<p style="color:red">❌ {{ session('error') }}</p>@endif

<hr>
<a href="{{ route('test.cart') }}">← Test Cart</a>
<a href="{{ route('test.download') }}">→ Test Download</a>
</body>
</html>
