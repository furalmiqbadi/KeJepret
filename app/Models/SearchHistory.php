<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    protected $fillable = [
        'user_id',
        'selfie_path',
        'event_id',
        'results_count',
        'status',
    ];
}