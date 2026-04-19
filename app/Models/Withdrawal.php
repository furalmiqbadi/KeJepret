<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'photographer_id',
        'amount',
        'bank_name',
        'account_number',
        'account_name',
        'status',
        'rejection_reason',
        'approved_by',
        'approved_at',
    ];

    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
