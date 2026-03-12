<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property int $barang_id
 * @property string $foto
 * @property bool $is_primary
 * @property int $urutan
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Barang $barang
 */
class BarangFoto extends Model
{
    use HasFactory;

    protected $table = 'barang_foto';

    protected $fillable = [
        'barang_id',
        'foto',
        'is_primary',
        'urutan',
        'keterangan',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'urutan' => 'integer',
        'barang_id' => 'integer',
    ];

    /**
     * Relasi ke Barang
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    /**
     * Accessor untuk URL foto lengkap
     */
    public function getFotoUrlAttribute()
    {
        if (!$this->foto) {
            return asset('images/no-image.png'); // Foto default jika kosong
        }

        // Cek jika foto sudah full URL
        if (filter_var($this->foto, FILTER_VALIDATE_URL)) {
            return $this->foto;
        }

        // Cek jika file ada di storage
        if (Storage::disk('public')->exists($this->foto)) {
            return Storage::url($this->foto);
        }

        // Fallback ke asset public
        return asset($this->foto);
    }

    /**
     * Accessor untuk path thumbnail (opsional, jika mau buat thumbnail)
     */
    public function getThumbnailUrlAttribute()
    {
        // Untuk sementara return foto biasa
        // Nanti bisa dikembangkan dengan intervention/image untuk generate thumbnail
        return $this->foto_url;
    }

    /**
     * Scope untuk foto primary
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /**
     * Scope untuk ordering berdasarkan urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Boot method untuk auto-handling
     */
    protected static function boot()
    {
        parent::boot();

        // Ketika foto baru dibuat sebagai primary, set yang lain jadi non-primary
        static::creating(function ($foto) {
            if ($foto->is_primary) {
                static::where('barang_id', $foto->barang_id)
                    ->where('is_primary', true)
                    ->update(['is_primary' => false]);
            }
        });

        // Ketika foto di-update jadi primary
        static::updating(function ($foto) {
            if ($foto->is_primary && $foto->isDirty('is_primary')) {
                static::where('barang_id', $foto->barang_id)
                    ->where('id', '!=', $foto->id)
                    ->where('is_primary', true)
                    ->update(['is_primary' => false]);
            }
        });

        // Ketika foto dihapus, hapus file dari storage
        static::deleting(function ($foto) {
            if ($foto->foto && Storage::disk('public')->exists($foto->foto)) {
                Storage::disk('public')->delete($foto->foto);
            }

            // Jika foto yang dihapus adalah primary, set foto pertama sebagai primary
            if ($foto->is_primary) {
                $firstFoto = static::where('barang_id', $foto->barang_id)
                    ->where('id', '!=', $foto->id)
                    ->ordered()
                    ->first();

                if ($firstFoto) {
                    $firstFoto->update(['is_primary' => true]);
                }
            }
        });
    }

    /**
     * Helper method: Set foto ini sebagai primary
     */
    public function setPrimary()
    {
        // Set semua foto barang ini jadi non-primary
        static::where('barang_id', $this->barang_id)
            ->update(['is_primary' => false]);

        // Set foto ini jadi primary
        $this->update(['is_primary' => true]);

        return $this;
    }

    /**
     * Helper method: Delete foto beserta file
     */
    public function deleteFoto()
    {
        // File akan otomatis terhapus via boot method deleting event
        return $this->delete();
    }
}