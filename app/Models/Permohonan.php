<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonan';

    protected $fillable = [
        'user_id',
        'no_permohonan',
        'dinas_status',
        'alasan_penolakan',
        'nama_pemohon',
        'alamat_pemohon',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'no_telp',
        'no_ktp',
        'nama_instansi',
        'jabatan',
        'bidang_instansi',
        'alamat_instansi',
        'kop_surat',
        'draft_surat',
        'surat_permohonan',
        'status',
        'tanggal_mulai',
        'tanggal_selesai', 
        'keperluan'
        
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Peminjaman (bisa banyak)
    public function peminjaman()
    {
        return $this->hasOne(Peminjaman::class, 'permohonan_id');
    }

    // Relasi ke Permohonan Items (multiple barang per permohonan)
    public function permohonanItems()
    {
        return $this->hasMany(PermohonanItem::class);
    }
    
    public function items()
    {
        return $this->hasMany(PermohonanItem::class);
    }

    // Relasi ke Barang melalui items
    public function barang()
    {
        return $this->hasManyThrough(Barang::class, PermohonanItem::class, 'permohonan_id', 'id', 'id', 'aset_id');
    }

    // Get total biaya permohonan - improved with eager loading check
    public function getTotalBiayaAttribute()
    {
        if (!$this->relationLoaded('items')) {
            $this->load('items.barang');
        }
        
        return $this->items->sum(function ($item) {
            return $item->jumlah * ($item->barang->harga_sewa ?? 0);
        });
    }

    // Accessor untuk nama aset - fixed
    public function getAsetNamesAttribute()
    {
        if (!$this->relationLoaded('items')) {
            $this->load('items.barang');
        }
        
        $namaBarang = $this->items->map(function ($item) {
            $nama = $item->barang->nama_barang ?? 'Unknown';
            return $item->jumlah > 1 ? "{$nama} ({$item->jumlah}x)" : $nama;
        })->toArray();
        
        return implode(', ', $namaBarang);
    }

    // Method untuk load semua aset dengan optimal loading
    public function loadAset()
    {
        return $this->load(['items.barang.kategori']);
    }

    // Scope untuk filter status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk user tertentu
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Method untuk check apakah sudah ada peminjaman
    public function hasPeminjaman()
    {
        return $this->peminjaman()->exists();
    }

    // Method untuk mendapatkan status badge class
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'Dalam Proses' => 'badge-warning',
            'Disetujui' => 'badge-success', 
            'Ditolak' => 'badge-danger',
            default => 'badge-secondary'
        };
    }
}
