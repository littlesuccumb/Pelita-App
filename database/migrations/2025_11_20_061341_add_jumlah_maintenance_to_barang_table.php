<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            // Tambah kolom jumlah_maintenance setelah jumlah_tersedia
            $table->integer('jumlah_maintenance')->default(0)->after('jumlah_tersedia');
        });
        
        DB::statement("
            UPDATE barang b
            SET b.jumlah_maintenance = COALESCE(
                (SELECT SUM(m.jumlah) 
                 FROM maintenance m 
                 WHERE m.aset_id = b.id 
                 AND m.jenis_aset = 'barang'
                 AND m.status IN ('dijadwalkan', 'dalam_proses')
                ), 0
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn('jumlah_maintenance');
        });
    }
};