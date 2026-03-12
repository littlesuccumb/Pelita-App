<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('maintenance', function (Blueprint $table) {
            $table->enum('status', ['dijadwalkan', 'dalam_proses', 'selesai', 'dibatalkan'])->default('dalam_proses')->after('deskripsi');
            $table->datetime('tanggal_selesai')->nullable()->after('status');
            $table->text('catatan_penyelesaian')->nullable()->after('tanggal_selesai');
            $table->string('jenis_maintenance')->nullable()->after('deskripsi'); // Untuk form maintenance
        });
    }

    public function down()
    {
        Schema::table('maintenance', function (Blueprint $table) {
            $table->dropColumn(['status', 'tanggal_selesai', 'catatan_penyelesaian', 'jenis_maintenance']);
        });
    }
};