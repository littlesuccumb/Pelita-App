<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_barang')->nullOnDelete();
            $table->string('kode_barang')->nullable()->unique();
            $table->string('nama_barang');
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_total')->default(1);
            $table->integer('jumlah_tersedia')->default(1);
            $table->enum('kondisi', ['baik','rusak ringan','rusak berat'])->default('baik');
            $table->string('lokasi')->nullable();
            $table->string('foto')->nullable();
            $table->decimal('harga_sewa', 14, 2)->default(0);
            $table->enum('status', ['tersedia','dipinjam','maintenance'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('barang');
    }
};
