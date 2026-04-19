<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Login Test</title><style>body{font-family:Arial,sans-serif;max-width:900px;margin:30px auto;padding:20px}form{border:1px solid #ddd;padding:20px;border-radius:8px}input,button{display:block;width:100%;padding:10px;margin:10px 0}button{background:#111;color:#fff;border:none}a{color:blue}.box{background:#f5f5f5;padding:15px;border-radius:8px;margin:15px 0}</style></head>
<body>
<h1>Test View - Auth Login</h1>
<div class="box">
<p><strong>Tujuan halaman:</strong> menampilkan form login untuk menguji <code>AuthController@login()</code>.</p>
<p><strong>Field:</strong> email, password.</p>
<p><strong>Jika berhasil:</strong> user diarahkan ke dashboard sesuai role.</p>
</div>
@if($errors->any())<div class="box" style="background:#ffe5e5">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
<form method="POST" action="{{ route('login.post') }}">
@csrf
<label>Email</label>
<input type="email" name="email" value="runner@test.com" required>
<label>Password</label>
<input type="password" name="password" value="password123" required>
<button type="submit">Login</button>
</form>
<p><a href="{{ route('register') }}">Ke halaman register</a></p>
</body>
</html>