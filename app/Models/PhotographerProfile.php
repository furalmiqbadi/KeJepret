<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotographerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'ktp_photo',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'verification_status',
        'verified_by',
        'verified_at',
        'rejection_reason',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    // Profil milik 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Admin yang memverifikasi
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Helper cek sudah verified
    public function isVerified(): bool
    {
        return $this->verification_status === 'verified';
    }
}