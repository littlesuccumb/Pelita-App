<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property int|null $kategori_id
 * @property string|null $kode_barang
 * @property string $nama_barang
 * @property string|null $merk
 * @property string|null $type
 * @property string|null $seri
 * @property int|null $tahun_produksi
 * @property string|null $spesifikasi
 * @property string|null $warna
 * @property float|null $berat
 * @property string|null $dimensi
 * @property string|null $garansi
 * @property \Illuminate\Support\Carbon|null $tanggal_pembelian
 * @property float|null $harga_beli
 * @property string|null $deskripsi
 * @property int $jumlah_total
 * @property int $jumlah_tersedia
 * @property string $kondisi
 * @property string|null $lokasi
 * @property string|null $foto
 * @property float $harga_sewa
 * @property string $status
 * @property bool $dapat_dipinjam
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\KategoriBarang|null $kategori
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Maintenance> $maintenances
 * @property-read int|null $maintenances_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PeminjamanDetail> $peminjamanDetails
 * @property-read int|null $peminjaman_details_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Peminjaman> $peminjaman
 * @property-read int|null $peminjaman_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PermohonanItem> $permohonanItems
 * @property-read int|null $permohonan_items_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereKodeBarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereNamaBarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereMerk($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereSeri($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereTahunProduksi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereSpesifikasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereWarna($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereBerat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereDimensi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereGaransi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereTanggalPembelian($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereHargaBeli($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereJumlahTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereJumlahTersedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereKondisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereHargaSewa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereDapatDipinjam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang dapatDipinjam()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang tidakDapatDipinjam()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang tersediaDanDapatDipinjam()
 * @mixin \Eloquent
 */
class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    
    protected $fillable = [
        'kategori_id',
        'kode_barang',
        'nama_barang',
        'merk',
        'type',
        'seri',
        'tahun_produksi',
        'spesifikasi',
        'warna',
        'berat',
        'dimensi',
        'garansi',
        'tanggal_pembelian',
        'harga_beli',
        'deskripsi',
        'jumlah_total',
        'jumlah_tersedia', 
        'kondisi',
        'lokasi',
        'foto',
        'harga_sewa',
        'status',
        'lainnya',
        'dapat_dipinjam', // ← DITAMBAHKAN
    ];

    protected $casts = [
        'harga_sewa' => 'decimal:2',
        'harga_beli' => 'decimal:2',
        'berat' => 'decimal:2',
        'tanggal_pembelian' => 'date',
        'tahun_produksi' => 'integer',
        'jumlah_total' => 'integer',
        'jumlah_tersedia' => 'integer',
        'dapat_dipinjam' => 'boolean', // ← DITAMBAHKAN
    ];

    protected $dates = [
        'tanggal_pembelian'
    ];

    // Constants for enum values
    const KONDISI_BAIK = 'baik';
    const KONDISI_RUSAK_RINGAN = 'rusak ringan';
    const KONDISI_RUSAK_BERAT = 'rusak berat';

    const STATUS_TERSEDIA = 'tersedia';
    const STATUS_DIPINJAM = 'dipinjam';
    const STATUS_MAINTENANCE = 'maintenance';

    /**
 * Relasi ke Foto Barang (Multiple Photos)
 */
public function fotos()
{
    return $this->hasMany(BarangFoto::class, 'barang_id')->ordered();
}

/**
 * Get foto primary/utama
 */
public function fotoPrimary()
{
    return $this->hasOne(BarangFoto::class, 'barang_id')->where('is_primary', true);
}

/**
 * Accessor untuk URL foto utama (backward compatible)
 */
public function getFotoUrlAttribute()
{
    // Cek dari relasi barang_foto dulu
    $fotoPrimary = $this->fotoPrimary;
    if ($fotoPrimary) {
        return $fotoPrimary->foto_url;
    }

    // Fallback ke kolom foto lama
    if ($this->foto) {
        if (filter_var($this->foto, FILTER_VALIDATE_URL)) {
            return $this->foto;
        }
        
        if (Storage::disk('public')->exists($this->foto)) {
            return Storage::url($this->foto);
        }
        
        return asset($this->foto);
    }

    // Default no image
    return asset('images/no-image.png');
}

    // Relationship dengan Kategori Barang
    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
    }

    public function kategoriBarang()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id');
    }

    // Relationship dengan Peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'aset_id')->where('jenis_aset', 'barang');
    }

    // Relationship dengan Peminjaman Detail
    public function peminjamanDetails()
    {
        return $this->hasMany(PeminjamanDetail::class, 'barang_id');
    }

    // Relationship dengan Permohonan Items
    public function permohonanItems()
    {
        return $this->hasMany(PermohonanItem::class, 'aset_id')->where('jenis_aset', 'barang');
    }

    // Relationship dengan Maintenance
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'aset_id')->where('jenis_aset', 'barang');
    }

    // Accessors
    public function getFullNameAttribute()
    {
        $parts = array_filter([
            $this->nama_barang,
            $this->merk,
            $this->type
        ]);
        
        return implode(' - ', $parts);
    }

        /**
     * Get jumlah unit yang sedang dalam maintenance
     */
    public function getJumlahMaintenanceAttribute()
    {
        return $this->maintenances()
            ->whereIn('status', ['dijadwalkan', 'dalam_proses'])
            ->sum('jumlah');
    }

    /**
     * Get jumlah benar-benar tersedia (tidak termasuk yang maintenance)
     */
    public function getJumlahBenarTersediaAttribute()
    {
        return $this->jumlah_total - $this->jumlah_dipinjam - $this->jumlah_maintenance;
    }
    
    public function getFormattedHargaSewaAttribute()
    {
        return 'Rp ' . number_format($this->harga_sewa, 0, ',', '.');
    }

    public function getFormattedHargaBeliAttribute()
    {
        if (!$this->harga_beli) return '-';
        return 'Rp ' . number_format($this->harga_beli, 0, ',', '.');
    }

    public function getFormattedBeratAttribute()
    {
        if (!$this->berat) return '-';
        return $this->berat . ' kg';
    }

    public function getIsAvailableAttribute()
    {
        return $this->status === self::STATUS_TERSEDIA 
               && $this->jumlah_tersedia > 0
               && $this->dapat_dipinjam; // ← DITAMBAHKAN validasi dapat_dipinjam
    }

    public function getStatusBadgeAttribute()
    {
        switch ($this->status) {
            case self::STATUS_TERSEDIA:
                return '<span class="badge bg-success">Tersedia</span>';
            case self::STATUS_DIPINJAM:
                return '<span class="badge bg-warning">Dipinjam</span>';
            case self::STATUS_MAINTENANCE:
                return '<span class="badge bg-danger">Maintenance</span>';
            default:
                return '<span class="badge bg-secondary">Unknown</span>';
        }
    }

    public function getKondisiBadgeAttribute()
    {
        switch ($this->kondisi) {
            case self::KONDISI_BAIK:
                return '<span class="badge bg-success">Baik</span>';
            case self::KONDISI_RUSAK_RINGAN:
                return '<span class="badge bg-warning">Rusak Ringan</span>';
            case self::KONDISI_RUSAK_BERAT:
                return '<span class="badge bg-danger">Rusak Berat</span>';
            default:
                return '<span class="badge bg-secondary">Unknown</span>';
        }
    }

    // ← ACCESSOR BARU untuk badge dapat_dipinjam
    public function getDapatDipinjamBadgeAttribute()
    {
        if ($this->dapat_dipinjam) {
            return '<span class="badge bg-success"><i class="bi bi-check-circle"></i> Dapat Dipinjam</span>';
        } else {
            return '<span class="badge bg-secondary"><i class="bi bi-x-circle"></i> Tidak Dapat Dipinjam</span>';
        }
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', self::STATUS_TERSEDIA)
                    ->where('jumlah_tersedia', '>', 0);
    }

    // ← SCOPE BARU untuk filter barang yang dapat dipinjam
    public function scopeDapatDipinjam($query)
    {
        return $query->where('dapat_dipinjam', true);
    }

    // ← SCOPE BARU untuk filter barang yang tidak dapat dipinjam
    public function scopeTidakDapatDipinjam($query)
    {
        return $query->where('dapat_dipinjam', false);
    }

    // ← SCOPE BARU kombinasi tersedia DAN dapat dipinjam
    public function scopeTersediaDanDapatDipinjam($query)
    {
        return $query->where('dapat_dipinjam', true)
                     ->where('status', self::STATUS_TERSEDIA)
                     ->where('jumlah_tersedia', '>', 0);
    }

    public function scopeByKategori($query, $kategoriId)
    {
        return $query->where('kategori_id', $kategoriId);
    }

    public function scopeByCondition($query, $kondisi)
    {
        return $query->where('kondisi', $kondisi);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama_barang', 'LIKE', "%{$search}%")
              ->orWhere('kode_barang', 'LIKE', "%{$search}%")
              ->orWhere('deskripsi', 'LIKE', "%{$search}%")
              ->orWhere('merk', 'LIKE', "%{$search}%")
              ->orWhere('type', 'LIKE', "%{$search}%")
              ->orWhere('seri', 'LIKE', "%{$search}%");
        });
    }

    // Helper methods
    public function canBeBorrowed($jumlah = 1)
    {
        return $this->dapat_dipinjam // ← DITAMBAHKAN validasi dapat_dipinjam
               && $this->status === self::STATUS_TERSEDIA 
               && $this->kondisi === self::KONDISI_BAIK 
               && $this->jumlah_tersedia >= $jumlah;
    }

    public function updateKetersediaan($jumlah, $operation = 'subtract')
    {
        if ($operation === 'subtract') {
            $this->jumlah_tersedia = max(0, $this->jumlah_tersedia - $jumlah);
        } else {
            $this->jumlah_tersedia = min($this->jumlah_total, $this->jumlah_tersedia + $jumlah);
        }
        
        // Update status based on availability
        if ($this->jumlah_tersedia == 0) {
            $this->status = self::STATUS_DIPINJAM;
        } else if ($this->jumlah_tersedia > 0 && $this->status === self::STATUS_DIPINJAM) {
            $this->status = self::STATUS_TERSEDIA;
        }
        
        $this->save();
    }
}