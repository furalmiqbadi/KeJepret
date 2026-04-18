<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchSession extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'event_id',
        'selfie_r2_path',
        'ai_runner_id',
        'enroll_status',
        'search_status',
        'result_count',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Sesi milik 1 runner
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Sesi terikat 1 event (nullable = global)
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Sesi punya banyak hasil foto
    public function searchResults()
    {
        return $this->hasMany(SearchResult::class);
    }
}