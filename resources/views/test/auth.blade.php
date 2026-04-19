<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Test Auth</title>
    <style>body{font-family:sans-serif;max-width:800px;margin:40px auto;padding:0 20px}h2{background:#333;color:#fff;padding:10px}form{border:1px solid #ccc;padding:20px;margin-bottom:30px}input,select{display:block;width:100%;margin:8px 0;padding:8px;box-sizing:border-box}button{background:#4CAF50;color:#fff;padding:10px 20px;border:none;cursor:pointer}a{display:inline-block;margin:5px;color:blue}</style>
</head>
<body>
<h1>🧪 TEST AUTH</h1>

<h2>REGISTER</h2>
<form method="POST" action="{{ route('register.post') }}">
    @csrf
    <input type="text" name="name" placeholder="Nama" value="Test User" required>
    <input type="email" name="email" placeholder="Email" value="test@test.com" required>
    <input type="password" name="password" placeholder="Password" value="password123" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" value="password123" required>
    <select name="role">
        <option value="runner">Runner</option>
        <option value="photographer">Photographer</option>
    </select>
    <input type="text" name="phone" placeholder="No HP" value="08123456789">
    <button type="submit">Register</button>
</form>

<h2>LOGIN</h2>
<form method="POST" action="{{ route('login.post') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" value="test@test.com" required>
    <input type="password" name="password" placeholder="Password" value="password123" required>
    <button type="submit">Login</button>
</form>

<h2>LOGOUT</h2>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

@if(session('success'))<p style="color:green">✅ {{ session('success') }}</p>@endif
@if(session('error'))<p style="color:red">❌ {{ session('error') }}</p>@endif
@if($errors->any())<ul style="color:red">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>@endif

<hr>
<a href="{{ route('test.cart') }}">→ Test Cart</a>
<a href="{{ route('test.photo') }}">→ Test Photo</a>
</body>
</html>
