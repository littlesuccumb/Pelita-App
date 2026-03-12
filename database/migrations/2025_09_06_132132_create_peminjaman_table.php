<?php

// ==========================================
// MIGRATION PEMINJAMAN (EDIT YANG UDAH ADA)
// ==========================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // RELASI KE PERMOHONAN
            $table->foreignId('permohonan_id')->nullable()->constrained('permohonan')->onDelete('set null');
            
            // ASET YANG DIREALISASI (bisa sama atau beda dari permohonan)
            $table->enum('jenis_aset', ['barang','ruangan']);
            $table->unsignedBigInteger('aset_id'); // ID spesifik dari tabel barang/ruangan
            
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->text('keperluan')->nullable();
            $table->enum('status', ['menunggu','disetujui','ditolak','selesai'])->default('menunggu');
            $table->decimal('biaya', 14, 2)->default(0);
            $table->string('berita_acara')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
};
