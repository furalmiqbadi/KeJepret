<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'photographer_id',
        'event_id',
        'filename',
        'r2_path',
        'r2_url',
        'watermark_path',
        'price',
        'ai_photo_id',
        'embed_status',
        'category',
        'is_active',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Foto milik 1 fotografer
    public function photographer()
    {
        return $this->belongsTo(User::class, 'photographer_id');
    }

    // Foto terikat 1 event (nullable = foto bebas)
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Foto punya banyak embedding wajah
    public function photoEmbeddings()
    {
        return $this->hasMany(PhotoEmbedding::class);
    }

    // Foto muncul di banyak hasil search
    public function searchResults()
    {
        return $this->hasMany(SearchResult::class);
    }

    // Foto masuk banyak keranjang
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Foto masuk banyak order
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper: sudah di-embed AI
    public function isEmbedded(): bool
    {
        return $this->embed_status === 'embedded';
    }
}