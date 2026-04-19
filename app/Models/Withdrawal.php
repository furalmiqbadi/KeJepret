<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'photographer_id',
        'amount',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'status',
        'approved_by',
        'approved_at',
        'rejection_reason',
        'transferred_at',
    ];

    protected $casts = [
        'amount'        => 'decimal:2',
        'approved_at'   => 'datetime',
        'transferred_at'=> 'datetime',
    ];

    // Withdrawal milik 1 fotografer
    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }

    // Admin yang approve
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Riwayat saldo dari withdrawal ini
    public function balanceTransaction()
    {
        return $this->hasOne(BalanceTransaction::class);
    }
}