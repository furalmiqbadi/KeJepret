<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Register Test</title><style>body{font-family:Arial,sans-serif;max-width:900px;margin:30px auto;padding:20px}form{border:1px solid #ddd;padding:20px;border-radius:8px}input,select,button{display:block;width:100%;padding:10px;margin:10px 0}button{background:#111;color:#fff;border:none}.box{background:#f5f5f5;padding:15px;border-radius:8px;margin:15px 0}</style></head>
<body>
<h1>Test View - Auth Register</h1>
<div class="box">
<p><strong>Tujuan halaman:</strong> menampilkan form register untuk <code>AuthController@register()</code>.</p>
<p><strong>Field:</strong> name, email, password, password_confirmation, role, phone.</p>
<p><strong>Jika role photographer:</strong> otomatis dibuatkan profile dan balance.</p>
</div>
@if($errors->any())<div class="box" style="background:#ffe5e5">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
<form method="POST" action="{{ route('register.post') }}">
@csrf
<input type="text" name="name" placeholder="Nama lengkap" value="Runner Test" required>
<input type="email" name="email" placeholder="Email" value="runner@test.com" required>
<input type="password" name="password" placeholder="Password" value="password123" required>
<input type="password" name="password_confirmation" placeholder="Konfirmasi password" value="password123" required>
<select name="role" required>
<option value="runner">Runner</option>
<option value="photographer">Photographer</option>
</select>
<input type="text" name="phone" placeholder="No HP" value="08123456789">
<button type="submit">Register</button>
</form>
</body>
</html>