<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'photo_id',
        'price',
        'created_at',
    ];

    protected $casts = [
        'price'      => 'decimal:2',
        'created_at' => 'datetime',
    ];

    // Item milik 1 runner
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Item menunjuk ke 1 foto
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}