<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * HATI-HATI: Migration ini akan mengubah stok barang!
     * Pastikan backup database dulu sebelum run.
     */
    public function up(): void
    {
        DB::transaction(function () {
            // Ambil semua peminjaman yang sudah DISETUJUI tapi belum SELESAI
            $peminjamanAktif = Peminjaman::where('status', 'disetujui')
                ->with('peminjamanDetail.barang')
                ->get();

            echo "\n=== FIXING STOCK FOR ACTIVE PEMINJAMAN ===\n";

            foreach ($peminjamanAktif as $peminjaman) {
                echo "\nPeminjaman ID: {$peminjaman->id}\n";
                
                foreach ($peminjaman->peminjamanDetail as $detail) {
                    $barang = $detail->barang;
                    
                    if (!$barang) {
                        echo "  ⚠️  Barang ID {$detail->barang_id} tidak ditemukan\n";
                        continue;
                    }

                    // Cek apakah stok sudah dikurangi atau belum
                    // Logika: jika jumlah_tersedia + jumlah_detail <= jumlah_total, berarti belum dikurangi
                    $shouldSubtract = ($barang->jumlah_tersedia + $detail->jumlah) <= $barang->jumlah_total;
                    
                    if ($shouldSubtract) {
                        $oldStock = $barang->jumlah_tersedia;
                        $barang->updateKetersediaan($detail->jumlah, 'subtract');
                        $newStock = $barang->jumlah_tersedia;
                        
                        echo "  ✅ {$barang->nama_barang}: Dikurangi {$detail->jumlah} unit ({$oldStock} → {$newStock})\n";
                    } else {
                        echo "  ⏭️  {$barang->nama_barang}: Sudah dikurangi sebelumnya (skip)\n";
                    }
                }
            }

            echo "\n=== FIXING COMPLETED ===\n\n";
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak bisa di-reverse karena kita tidak tau stok awal yang benar
        echo "⚠️ WARNING: Migration ini tidak bisa di-rollback otomatis.\n";
        echo "   Restore database dari backup jika ingin kembali.\n";
    }
};