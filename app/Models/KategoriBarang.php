<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $nama_kategori
 * @property string|null $deskripsi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Barang> $barangs
 * @property-read int|null $barangs_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KategoriBarang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KategoriBarang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KategoriBarang query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KategoriBarang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KategoriBarang whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KategoriBarang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KategoriBarang whereNamaKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KategoriBarang whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class KategoriBarang extends Model
{
    use HasFactory;

    protected $table = 'kategori_barang';
    
    protected $fillable = [
        'nama_kategori',
        'deskripsi'
    ];

    // Relationship dengan Barang
    public function barang()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}
