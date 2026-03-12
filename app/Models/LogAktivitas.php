<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string $tipe
 * @property string $aksi
 * @property string|null $detail
 * @property string|null $url
 * @property bool $is_read
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @property-read string $icon
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LogAktivitas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LogAktivitas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LogAktivitas query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LogAktivitas aktivitas()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LogAktivitas notifikasi()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LogAktivitas unread()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LogAktivitas byUser($userId)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LogAktivitas byAksi($aksi)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|LogAktivitas byDate($startDate, $endDate = null)
 * @mixin \Eloquent
 */
class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';
    
    protected $fillable = [
        'user_id',
        'tipe',
        'aksi',
        'detail',
        'url',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    // ==========================================
    // RELATIONSHIPS
    // ==========================================
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ==========================================
    // SCOPES - EXISTING (Tetap dipertahankan)
    // ==========================================
    
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByAksi($query, $aksi)
    {
        return $query->where('aksi', 'LIKE', "%{$aksi}%");
    }

    public function scopeByDate($query, $startDate, $endDate = null)
    {
        if ($endDate) {
            return $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        
        return $query->whereDate('created_at', $startDate);
    }

    // ==========================================
    // SCOPES - NEW (Untuk notifikasi)
    // ==========================================
    
    /**
     * Scope untuk filter log aktivitas biasa
     */
    public function scopeAktivitas($query)
    {
        return $query->where('tipe', 'aktivitas');
    }

    /**
     * Scope untuk filter notifikasi
     */
    public function scopeNotifikasi($query)
    {
        return $query->where('tipe', 'notifikasi');
    }

    /**
     * Scope untuk notifikasi yang belum dibaca
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope untuk mendapatkan notifikasi terbaru
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->latest()->limit($limit);
    }

    // ==========================================
    // ACCESSORS - EXISTING (Tetap dipertahankan)
    // ==========================================
    
    public function getWaktuAttribute()
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }

    public function getNamaUserAttribute()
    {
        return $this->user ? $this->user->name : 'System';
    }

    // ==========================================
    // ACCESSORS - NEW (Untuk notifikasi)
    // ==========================================
    
    /**
     * Get icon berdasarkan aksi untuk notifikasi
     * Returns: 'success', 'error', 'warning', 'info'
     */
    public function getIconAttribute()
    {
        $aksi = strtolower($this->aksi);
        
        // Success cases
        if (
            str_contains($aksi, 'disetujui') || 
            str_contains($aksi, 'dikonfirmasi') || 
            str_contains($aksi, 'berhasil') ||
            str_contains($aksi, 'selesai') ||
            str_contains($aksi, 'lunas')
        ) {
            return 'success';
        }
        
        // Error cases
        if (
            str_contains($aksi, 'ditolak') || 
            str_contains($aksi, 'gagal') ||
            str_contains($aksi, 'batal') ||
            str_contains($aksi, 'error')
        ) {
            return 'error';
        }
        
        // Warning cases
        if (
            str_contains($aksi, 'menunggu') || 
            str_contains($aksi, 'reminder') ||
            str_contains($aksi, 'deadline') ||
            str_contains($aksi, 'peringatan')
        ) {
            return 'warning';
        }
        
        // Default to info
        return 'info';
    }

    // ==========================================
    // METHODS - EXISTING (Tetap dipertahankan)
    // ==========================================
    
    /**
     * Helper method untuk mencatat log aktivitas dengan mudah
     */
    public static function catat($aksi, $detail = null, $userId = null)
    {
        return static::create([
            'user_id' => $userId ?? Auth::id(),
            'tipe' => 'aktivitas', // Default ke aktivitas
            'aksi' => $aksi,
            'detail' => $detail,
        ]);
    }

    // ==========================================
    // METHODS - NEW (Untuk notifikasi)
    // ==========================================
    
    /**
     * Mark notifikasi sebagai sudah dibaca
     */
    public function markAsRead()
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now()
            ]);
        }
        
        return $this;
    }

    /**
     * Mark notifikasi sebagai belum dibaca
     */
    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null
        ]);
        
        return $this;
    }

    /**
     * Check apakah ini adalah notifikasi
     */
    public function isNotifikasi()
    {
        return $this->tipe === 'notifikasi';
    }

    /**
     * Check apakah ini adalah aktivitas biasa
     */
    public function isAktivitas()
    {
        return $this->tipe === 'aktivitas';
    }

    /**
     * Helper untuk membuat notifikasi (static method)
     */
    public static function createNotifikasi($userId, $aksi, $detail, $url = null)
    {
        return static::create([
            'user_id' => $userId,
            'tipe' => 'notifikasi',
            'aksi' => $aksi,
            'detail' => $detail,
            'url' => $url,
            'is_read' => false
        ]);
    }

    /**
     * Get formatted time untuk display
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}