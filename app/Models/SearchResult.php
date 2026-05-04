<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchResult extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'search_session_id',
        'photo_id',
        'similarity_score',
        'created_at',
    ];

    protected $casts = [
        'similarity_score' => 'decimal:2',
        'created_at'       => 'datetime',
    ];

    // Hasil milik 1 sesi search
    public function searchSession()
    {
        return $this->belongsTo(SearchSession::class);
    }

    // Hasil menunjuk ke 1 foto
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}