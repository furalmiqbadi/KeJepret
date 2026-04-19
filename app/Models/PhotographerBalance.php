<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotographerBalance extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'photographer_id',
        'balance',
        'total_earned',
        'updated_at',
    ];

    protected $casts = [
        'balance'      => 'decimal:2',
        'total_earned' => 'decimal:2',
        'updated_at'   => 'datetime',
    ];

    // Saldo milik 1 fotografer
    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }
}