<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'photo_id',
        'photographer_id',
        'price',
        'photographer_amount',
        'download_token',
        'downloaded_at',
        'created_at',
    ];

    protected $casts = [
        'price'               => 'decimal:2',
        'photographer_amount' => 'decimal:2',
        'downloaded_at'       => 'datetime',
        'created_at'          => 'datetime',
    ];

    // Item milik 1 order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Item menunjuk ke 1 foto
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    // Item milik 1 fotografer
    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }

    // Riwayat saldo dari item ini
    public function balanceTransaction()
    {
        return $this->hasOne(BalanceTransaction::class);
    }
}