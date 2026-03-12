<?php
// ==========================================
// MIGRATION PERMOHONAN (EDIT YANG UDAH ADA)
// ==========================================

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            $table->string('no_permohonan')->unique();
            
            // USER ID
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Data Pemohon (snapshot dari users)
            $table->enum('dinas_status', ['Dinas', 'Non Dinas'])->default('Non Dinas');
            $table->string('sub_sektor')->nullable();
            $table->string('nama_pemohon');
            $table->string('alamat_pemohon')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('no_ktp')->nullable();

            // Data Instansi
            $table->string('nama_instansi')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('bidang_instansi')->nullable();
            $table->string('alamat_instansi')->nullable();

            // Informasi Kegiatan
            $table->string('nama_kegiatan');
            $table->string('bidang_kegiatan')->nullable();
            $table->date('tanggal_kegiatan')->nullable();
            $table->string('sesi')->nullable();
            $table->integer('jumlah_peserta')->nullable();
            
            // ASET YANG DIMINTA (sama kayak peminjaman)
            $table->enum('jenis_aset', ['barang', 'ruangan']);
            $table->unsignedBigInteger('aset_id'); // ID spesifik dari tabel barang/ruangan
            
            $table->string('surat_permohonan')->nullable();
            $table->enum('status', ['Dalam Proses', 'Disetujui', 'Ditolak'])->default('Dalam Proses');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('permohonan');
    }
};
