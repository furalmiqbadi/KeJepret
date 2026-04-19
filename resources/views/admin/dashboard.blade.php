<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Admin Dashboard</title><style>body{font-family:Arial,sans-serif;max-width:1100px;margin:30px auto;padding:20px}.grid{display:grid;grid-template-columns:repeat(3,1fr);gap:15px}.card{background:#f5f5f5;padding:20px;border-radius:8px}.nav{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:20px}.nav a{color:blue;text-decoration:none}.logout-btn{background:#c00;color:#fff;border:none;padding:8px 16px;border-radius:4px;cursor:pointer}</style></head>
<body>
<h1>Admin Dashboard</h1>
<div class="nav">
  <a href="{{ route('admin.photographers.pending') }}">👥 Pending Photographers</a>
  <a href="{{ route('admin.events.index') }}">📅 Events</a>
  <a href="{{ route('admin.withdrawals.pending') }}">💸 Pending Withdrawals</a>
  <form method="POST" action="{{ route('logout') }}" style="margin:0">
    @csrf
    <button class="logout-btn" type="submit">🚪 Logout</button>
  </form>
</div>
<div class="grid">
  <div class="card">Total Users: {{ $totalUsers ?? 0 }}</div>
  <div class="card">Total Photographers: {{ $totalPhotographers ?? 0 }}</div>
  <div class="card">Total Photos: {{ $totalPhotos ?? 0 }}</div>
  <div class="card">Total Orders Paid: {{ $totalOrders ?? 0 }}</div>
  <div class="card">Pending Withdrawals: {{ $pendingWithdrawals ?? 0 }}</div>
  <div class="card">Pending Verification: {{ $pendingVerif ?? 0 }}</div>
</div>
</body>
</html>