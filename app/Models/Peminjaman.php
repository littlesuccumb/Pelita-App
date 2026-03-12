<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    
    protected $fillable = [
        'user_id',
        'permohonan_id',
        'jenis_aset',
        'aset_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'keperluan',
        'status',
        'biaya',
        'berita_acara'
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'biaya' => 'decimal:2'
    ];

    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Permohonan
    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class, 'permohonan_id');
    }

    // Relationship dengan Barang (hanya barang sekarang)
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'aset_id', 'id');
    }

    // Relationship lainnya
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function peminjamanDetail()
    {
        return $this->hasMany(PeminjamanDetail::class);
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class);
    }

    // Accessor untuk nama aset - hanya barang
    public function getAsetNameAttribute()
    {
        if ($this->barang) {
            return $this->barang->nama_barang;
        }
        return 'Barang tidak ditemukan';
    }

    // Method untuk load aset - hanya barang
    public function loadAset()
    {
        $this->load(['barang.kategori']);
        return $this;
    }

    // Jumlah barang yang dipinjam
    public function getJumlahAttribute()
    {
        return $this->peminjamanDetail ? $this->peminjamanDetail->sum('jumlah') : 1;
    }
}