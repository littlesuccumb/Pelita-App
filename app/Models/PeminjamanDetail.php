<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $peminjaman_id
 * @property int $barang_id
 * @property int $jumlah
 * @property string $harga_satuan
 * @property string $subtotal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Barang $barang
 * @property-read \App\Models\Peminjaman $peminjaman
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeminjamanDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeminjamanDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeminjamanDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeminjamanDetail whereBarangId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeminjamanDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeminjamanDetail whereHargaSatuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeminjamanDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeminjamanDetail whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeminjamanDetail wherePeminjamanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeminjamanDetail whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PeminjamanDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PeminjamanDetail extends Model
{
    protected $table = 'peminjaman_detail';

    protected $fillable = ['peminjaman_id','barang_id','jumlah','harga_satuan','subtotal'];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
