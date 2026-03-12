<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



/**
 * @property int $id
 * @property int $peminjaman_id
 * @property string $metode
 * @property string $jumlah
 * @property string $status
 * @property string|null $bukti_transfer
 * @property string|null $tanggal_bayar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Peminjaman $peminjaman
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereBuktiTransfer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereMetode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran wherePeminjamanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereTanggalBayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pembayaran whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    
    protected $fillable = [
        'peminjaman_id',
        'metode',
        'jumlah',
        'status',
        'bukti_transfer',
        'tanggal_bayar'
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
        'tanggal_bayar' => 'datetime'
    ];

    // Relationship dengan Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}

