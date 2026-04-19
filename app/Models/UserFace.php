<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFace extends Model
{
    protected $fillable = ['user_id', 'face_url'];

    /**
     * Get the user that owns the face data.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
