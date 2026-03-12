<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationOtp extends Model
{
    protected $fillable = [
        'email',
        'otp',
        'expires_at',
        'is_used'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
    ];

    /**
     * Generate random 6 digit OTP
     */
    public static function generateOTP(): string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Cek apakah OTP masih valid
     */
    public function isValid(): bool
    {
        return !$this->is_used && now()->lt($this->expires_at);
    }

    /**
     * Tandai OTP sebagai sudah digunakan
     */
    public function markAsUsed(): void
    {
        $this->update(['is_used' => true]);
    }
}