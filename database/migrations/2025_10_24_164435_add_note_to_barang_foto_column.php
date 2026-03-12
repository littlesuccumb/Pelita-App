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
            // Ubah comment kolom foto yang lama
            $table->string('foto')->nullable()->comment('DEPRECATED: Foto utama barang (gunakan relasi barang_foto untuk multiple foto)')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->string('foto')->nullable()->comment(null)->change();
        });
    }
};