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
        // 1. Buat tabel permohonan_items
        Schema::create('permohonan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id')->constrained('permohonan')->onDelete('cascade');
            $table->enum('jenis_aset', ['barang'])->default('barang');
            $table->foreignId('aset_id')->constrained('barang')->onDelete('cascade');
            $table->integer('jumlah')->default(1);
            $table->timestamps();
        });

        // 2. Hapus kolom aset_id dari tabel permohonan (karena pindah ke permohonan_items)
        Schema::table('permohonan', function (Blueprint $table) {
            $table->dropColumn(['jenis_aset', 'aset_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan kolom ke permohonan
        Schema::table('permohonan', function (Blueprint $table) {
            $table->enum('jenis_aset', ['barang'])->after('jumlah_peserta');
            $table->unsignedBigInteger('aset_id')->after('jenis_aset');
        });

        // Hapus tabel permohonan_items
        Schema::dropIfExists('permohonan_items');
    }
};