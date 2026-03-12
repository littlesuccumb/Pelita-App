<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';

    protected $fillable = [
        'jenis_aset',
        'aset_id',
        'jumlah', // TAMBAHKAN INI
        'tanggal',
        'deskripsi',
        'jenis_maintenance',
        'status',
        'tanggal_selesai',
        'catatan_penyelesaian',
        'biaya',
        'teknisi',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'biaya' => 'decimal:2',
        'jumlah' => 'integer', // TAMBAHKAN INI
    ];

    /**
     * Relation to Barang model
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'aset_id');
    }

    /**
     * Accessor untuk mendapatkan nama barang
     */
    public function getNamaAsetAttribute()
    {
        return $this->barang ? $this->barang->nama_barang : '-';
    }

    /**
     * Accessor untuk mendapatkan kode barang
     */
    public function getKodeAsetAttribute()
    {
        return $this->barang ? $this->barang->kode_barang : '-';
    }

    /**
     * Accessor untuk format biaya
     */
    public function getBiayaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->biaya, 0, ',', '.');
    }

    /**
     * Accessor untuk format tanggal
     */
    public function getTanggalFormattedAttribute()
    {
        return $this->tanggal ? $this->tanggal->format('d/m/Y H:i') : '-';
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'selesai' => 'success',
            'dalam_proses' => 'warning',
            'dijadwalkan' => 'info',
            'dibatalkan' => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Scope untuk maintenance hari ini
     */
    public function scopeToday($query)
    {
        return $query->whereDate('tanggal', today());
    }

    /**
     * Scope untuk maintenance bulan ini
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year);
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($maintenance) {
            $maintenance->jenis_aset = 'barang';
            
            // Set status default jika tidak diisi
            if (empty($maintenance->status)) {
                $maintenance->status = 'dalam_proses';
            }
            
            // Set jumlah default jika tidak diisi
            if (empty($maintenance->jumlah)) {
                $maintenance->jumlah = 1;
            }
        });
    }
}