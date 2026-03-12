<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PasswordResetOtp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'otp',
        'expires_at',
        'is_used',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check apakah OTP masih valid
     */
    public function isValid(): bool
    {
        return !$this->is_used && $this->expires_at->isFuture();
    }

    /**
     * Generate OTP baru
     */
    public static function generateOtp($userId): string
    {
        // Hapus OTP lama yang belum digunakan
        self::where('user_id', $userId)
            ->where('is_used', false)
            ->delete();

        // Generate OTP 6 digit
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Simpan OTP baru
        self::create([
            'user_id' => $userId,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10), // Valid 10 menit
            'is_used' => false,
        ]);

        return $otp;
    }

    /**
     * Verifikasi OTP
     */
    public static function verify($userId, $otp): bool
    {
        $otpRecord = self::where('user_id', $userId)
            ->where('otp', $otp)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($otpRecord) {
            $otpRecord->update(['is_used' => true]);
            return true;
        }

        return false;
    }
}