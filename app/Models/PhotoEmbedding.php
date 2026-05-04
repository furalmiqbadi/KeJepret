<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoEmbedding extends Model
{
    protected $fillable = [
        'photo_id',
        'ai_photo_id',
        'face_index',
        'embedding',
    ];

    // Embedding milik 1 foto
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}