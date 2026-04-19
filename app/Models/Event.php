<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'created_by',
        'name',
        'slug',
        'description',
        'location',
        'event_date',
        'cover_image',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_active'  => 'boolean',
    ];

    // Admin pembuat event
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Event punya banyak foto
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    // Event punya banyak sesi search
    public function searchSessions()
    {
        return $this->hasMany(SearchSession::class);
    }
}