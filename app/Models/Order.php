<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_code',
        'total_amount',
        'platform_fee',
        'photographer_amount',
        'payment_channel',
        'tripay_reference',
        'tripay_pay_url',
        'status',
        'paid_at',
        'expired_at',
    ];

    protected $casts = [
        'total_amount'        => 'decimal:2',
        'platform_fee'        => 'decimal:2',
        'photographer_amount' => 'decimal:2',
        'paid_at'             => 'datetime',
        'expired_at'          => 'datetime',
    ];

    // Order milik 1 runner
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Order punya banyak item foto
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper cek sudah dibayar
    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }
}