<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'avatar',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active'         => 'boolean',
        'password'          => 'hashed',
    ];

    // ═══════════════════════════════
    // RELASI
    // ═══════════════════════════════

    // Fotografer punya 1 profil
    public function photographerProfile()
    {
        return $this->hasOne(PhotographerProfile::class);
    }

    // Fotografer punya banyak foto
    public function photos()
    {
        return $this->hasMany(Photo::class, 'photographer_id');
    }

    // Runner punya banyak sesi search
    public function searchSessions()
    {
        return $this->hasMany(SearchSession::class);
    }

    // Runner punya banyak item di keranjang
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Runner punya banyak order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Fotografer punya 1 saldo
    public function photographerBalance()
    {
        return $this->hasOne(PhotographerBalance::class, 'photographer_id');
    }

    // Fotografer punya banyak riwayat saldo
    public function balanceTransactions()
    {
        return $this->hasMany(BalanceTransaction::class, 'photographer_id');
    }

    // Fotografer punya banyak withdrawal
    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class, 'photographer_id');
    }

    // ═══════════════════════════════
    // HELPER ROLE
    // ═══════════════════════════════

    public function isRunner(): bool
    {
        return $this->role === 'runner';
    }

    public function isPhotographer(): bool
    {
        return $this->role === 'photographer';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}