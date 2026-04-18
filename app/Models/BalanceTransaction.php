<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceTransaction extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'photographer_id',
        'order_item_id',
        'withdraw_id',
        'type',
        'amount',
        'balance_after',
        'description',
        'created_at',
    ];

    protected $casts = [
        'amount'        => 'decimal:2',
        'balance_after' => 'decimal:2',
        'created_at'    => 'datetime',
    ];

    // Transaksi milik 1 fotografer
    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }

    // Source credit: dari penjualan foto
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    // Source debit: dari withdrawal
    public function withdrawal()
    {
        return $this->belongsTo(Withdrawal::class, 'withdraw_id');
    }
}