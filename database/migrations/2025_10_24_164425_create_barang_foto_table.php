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
        Schema::create('barang_foto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')
                  ->constrained('barang')
                  ->onDelete('cascade')
                  ->comment('ID barang yang memiliki foto ini');
            
            $table->string('foto')
                  ->comment('Path file foto');
            
            $table->boolean('is_primary')
                  ->default(false)
                  ->comment('Apakah foto ini foto utama (1=Ya, 0=Tidak)');
            
            $table->integer('urutan')
                  ->default(0)
                  ->comment('Urutan tampilan foto (semakin kecil semakin depan)');
            
            $table->string('keterangan')->nullable()
                  ->comment('Keterangan/caption foto');
            
            $table->timestamps();
            
            // Index untuk performa query
            $table->index(['barang_id', 'is_primary']);
            $table->index(['barang_id', 'urutan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_foto');
    }
};