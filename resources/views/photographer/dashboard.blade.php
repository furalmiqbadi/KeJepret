<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Photographer Dashboard</title><style>body{font-family:Arial,sans-serif;max-width:900px;margin:30px auto;padding:20px}.card{background:#f5f5f5;padding:20px;border-radius:8px;margin:10px 0}.nav{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:20px}.nav a{color:blue;text-decoration:none}.logout-btn{background:#c00;color:#fff;border:none;padding:8px 16px;border-radius:4px;cursor:pointer}</style></head>
<body>
<h1>Photographer Dashboard</h1>
<div class="nav">
  <a href="{{ route('photographer.photos') }}">📷 Photos</a>
  <a href="{{ route('photographer.photos.upload') }}">⬆️ Upload</a>
  <a href="{{ route('balance.index') }}">💰 Balance</a>
  <a href="{{ route('balance.sales') }}">📊 Sales</a>
  <a href="{{ route('balance.withdraw') }}">🏦 Withdraw</a>
  <form method="POST" action="{{ route('logout') }}" style="margin:0">
    @csrf
    <button class="logout-btn" type="submit">🚪 Logout</button>
  </form>
</div>
<div class="card">
  <p>Halaman ini muncul setelah login photographer berhasil.</p>
  <p><strong>User login:</strong> {{ auth()->user()->name ?? '-' }}</p>
  <p><strong>Email:</strong> {{ auth()->user()->email ?? '-' }}</p>
</div>
</body>
</html>