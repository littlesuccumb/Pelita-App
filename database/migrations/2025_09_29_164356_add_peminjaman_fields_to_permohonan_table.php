// File: database/migrations/xxxx_add_peminjaman_fields_to_permohonan_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->datetime('tanggal_mulai')->nullable()->after('alamat_instansi');
            $table->datetime('tanggal_selesai')->nullable()->after('tanggal_mulai');
            $table->text('keperluan')->nullable()->after('tanggal_selesai');
        });
    }

    public function down()
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->dropColumn(['tanggal_mulai', 'tanggal_selesai', 'keperluan']);
        });
    }
};