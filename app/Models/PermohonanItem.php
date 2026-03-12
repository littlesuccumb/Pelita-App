<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanItem extends Model
{
    use HasFactory;

    protected $table = 'permohonan_items';
    
    protected $fillable = [
        'permohonan_id',
        'jenis_aset', // Selalu 'barang' sekarang
        'aset_id',
        'jumlah'
    ];

    // Relationship to permohonan
    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class);
    }

    // Relationship ke barang (hanya barang sekarang)
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'aset_id');
    }

    // Accessor untuk nama barang
    public function getNamaAsetAttribute()
    {
        return $this->barang ? $this->barang->nama_barang : 'Barang tidak ditemukan';
    }

    // Accessor untuk harga barang
    public function getHargaAsetAttribute()
    {
        return $this->barang ? $this->barang->harga_sewa : 0;
    }

    // Calculate subtotal for this item
    public function getSubtotalAttribute()
    {
        return $this->harga_aset * $this->jumlah;
    }
}