<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotographerNotification extends Model
{
    protected $fillable = [
        'photographer_id',
        'order_item_id',
        'order_id',
        'photo_id',
        'type',
        'title',
        'message',
        'amount',
        'read_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'read_at' => 'datetime',
    ];
}
