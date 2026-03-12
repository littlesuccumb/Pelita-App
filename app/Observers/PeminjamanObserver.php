<?php

namespace App\Observers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Support\Facades\Log;

class PeminjamanObserver
{
    /**
     * Handle the Peminjaman "deleting" event.
     * 
     * Dipanggil SEBELUM data peminjaman dihapus.
     * Kita kembalikan stok barang jika status peminjaman = 'disetujui'
     */
    public function deleting(Peminjaman $peminjaman)
    {
        // Hanya kembalikan stok jika peminjaman sudah disetujui
        if ($peminjaman->status === 'disetujui') {
            
            Log::info("Observer: Mengembalikan stok untuk peminjaman ID {$peminjaman->id}");
            
            // Loop semua detail barang
            foreach ($peminjaman->peminjamanDetail as $detail) {
                $barang = Barang::find($detail->barang_id);
                
                if (!$barang) {
                    Log::warning("Observer: Barang ID {$detail->barang_id} tidak ditemukan");
                    continue;
                }
                
                // Kembalikan stok
                $oldStock = $barang->jumlah_tersedia;
                $barang->updateKetersediaan($detail->jumlah, 'add');
                
                Log::info("Observer: Mengembalikan stok {$barang->nama_barang} sebanyak {$detail->jumlah} unit ({$oldStock} → {$barang->jumlah_tersedia})");
            }
        }
    }

    /**
     * Handle the Peminjaman "deleted" event.
     * 
     * Dipanggil SETELAH data peminjaman dihapus.
     * Kita bisa log atau cleanup lainnya di sini.
     */
    public function deleted(Peminjaman $peminjaman)
    {
        Log::info("Observer: Peminjaman ID {$peminjaman->id} berhasil dihapus");
    }
}