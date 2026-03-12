<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\BarangFoto;

class MigrateBarangFotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua barang yang memiliki foto
        $barangs = Barang::whereNotNull('foto')
                        ->where('foto', '!=', '')
                        ->get();

        foreach ($barangs as $barang) {
            // Cek apakah foto sudah di-migrate
            $exists = BarangFoto::where('barang_id', $barang->id)
                               ->where('foto', $barang->foto)
                               ->exists();

            if (!$exists) {
                // Buat entry baru di barang_foto
                BarangFoto::create([
                    'barang_id' => $barang->id,
                    'foto' => $barang->foto,
                    'is_primary' => true, // Set sebagai foto utama
                    'urutan' => 0, // Urutan pertama
                    'keterangan' => 'Foto utama (migrasi dari sistem lama)'
                ]);

                $this->command->info("✓ Migrated foto for: {$barang->nama_barang}");
            } else {
                $this->command->warn("⚠ Skipped (already exists): {$barang->nama_barang}");
            }
        }

        $this->command->info("\n✓ Migration selesai! Total: {$barangs->count()} barang");
    }
}