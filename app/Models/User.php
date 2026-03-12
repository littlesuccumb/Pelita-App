<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'avatar', 'password', 'role', 
        'jabatan', 'instansi', 'no_telp', 'alamat', 'no_ktp',
        'kelurahan', 'kecamatan', 'kabupaten', 'kode_pos', 'nama_organisasi'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // RELATIONSHIPS
    public function peminjaman()
    {
        return $this->hasMany(\App\Models\Peminjaman::class, 'user_id');
    }

    public function logAktivitas()
    {
        return $this->hasMany(\App\Models\LogAktivitas::class, 'user_id');
    }  

    public function permohonan()
    {
        return $this->hasMany(Permohonan::class, 'user_id');
    }

    public function notifikasi()
    {
        return $this->hasMany(\App\Models\LogAktivitas::class, 'user_id')
                    ->where('tipe', 'notifikasi')
                    ->latest();
    }

    public function unreadNotifikasi()
    {
        return $this->notifikasi()->unread();
    }

    // METHODS
    public function hasRole($roles)
    {
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }
        return $this->role === $roles;
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            return Storage::url($this->avatar);
        }
        return $this->getDefaultAvatarUrl();
    }

    public function getDefaultAvatarUrl(): string
    {
        $name = urlencode($this->name);
        $colors = ['3b82f6', '8b5cf6', 'ec4899', 'f59e0b', '10b981', 'ef4444', '6366f1', '14b8a6', 'f97316'];
        $color = $colors[ord($this->name[0]) % count($colors)];
        return "https://ui-avatars.com/api/?name={$name}&size=200&background={$color}&color=ffffff&bold=true&rounded=true";
    }

    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->name, 0, 2));
    }

    public function deleteAvatar(): void
    {
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            Storage::disk('public')->delete($this->avatar);
        }
    }

    // NOTIFICATION METHODS
    public function getUnreadNotificationsCountAttribute(): int
    {
        return $this->notifikasi()->unread()->count();
    }

    /**
     * Kirim notifikasi custom (RENAMED dari notify)
     */
    public function sendNotification($aksi, $detail, $url = null)
    {
        return LogAktivitas::createNotifikasi($this->id, $aksi, $detail, $url);
    }

    public function markAllNotificationsAsRead()
    {
        return $this->notifikasi()
                    ->unread()
                    ->update([
                        'is_read' => true,
                        'read_at' => now()
                    ]);
    }

    public function deleteOldNotifications($days = 30)
    {
        return $this->notifikasi()
                    ->where('created_at', '<', now()->subDays($days))
                    ->delete();
    }

    public function getRecentNotifications($limit = 5)
    {
        return $this->notifikasi()
                    ->recent($limit)
                    ->get();
    }

    public function hasUnreadNotifications(): bool
    {
        return $this->unread_notifications_count > 0;
    }

    // PASSWORD RESET OVERRIDE
    /**
     * Override untuk menghindari konflik dengan sendNotification()
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \Illuminate\Auth\Notifications\ResetPassword($token));
    }

    // BOOT
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->deleteAvatar();
            \App\Models\PasswordResetOtp::where('user_id', $user->id)->delete();
            $user->notifikasi()->delete();
        });
    }
}