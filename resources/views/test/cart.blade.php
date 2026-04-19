<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Cart</title>
    <style>body{font-family:sans-serif;max-width:800px;margin:40px auto;padding:0 20px}h2{background:#333;color:#fff;padding:10px}form{border:1px solid #ccc;padding:20px;margin-bottom:30px}input{display:block;width:100%;margin:8px 0;padding:8px;box-sizing:border-box}button{background:#4CAF50;color:#fff;padding:10px 20px;border:none;cursor:pointer}a{display:inline-block;margin:5px;color:blue}</style>
</head>
<body>
<h1>🧪 TEST CART</h1>
<p>Login sebagai: <strong>{{ auth()->user()->name ?? 'Belum login' }}</strong> | Role: <strong>{{ auth()->user()->role ?? '-' }}</strong></p>

<h2>LIHAT ISI CART</h2>
<a href="{{ route('cart.index') }}"><button>GET /runner/cart</button></a>

<h2>TAMBAH FOTO KE CART</h2>
<form method="POST" action="{{ route('cart.add') }}">
    @csrf
    <input type="number" name="photo_id" placeholder="Photo ID" value="1" required>
    <button type="submit">Tambah ke Cart</button>
</form>

<h2>HAPUS ITEM DARI CART</h2>
<form method="POST" action="{{ route('cart.remove', ['id' => 1]) }}">
    @csrf
    @method('DELETE')
    <input type="number" name="cart_item_id" placeholder="Cart Item ID" value="1">
    <button type="submit" style="background:red">Hapus dari Cart (ID=1)</button>
</form>

@if(session('success'))<p style="color:green">✅ {{ session('success') }}</p>@endif
@if(session('error'))<p style="color:red">❌ {{ session('error') }}</p>@endif

<hr>
<a href="{{ route('test.auth') }}">← Test Auth</a>
<a href="{{ route('test.order') }}">→ Test Order</a>
</body>
</html>
