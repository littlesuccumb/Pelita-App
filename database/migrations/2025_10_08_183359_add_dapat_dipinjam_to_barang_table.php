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
            $table->boolean('dapat_dipinjam')
                  ->default(true)
                  ->after('status')
                  ->comment('Menentukan apakah barang dapat dipinjam (1=Ya, 0=Tidak)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn('dapat_dipinjam');
        });
    }
};