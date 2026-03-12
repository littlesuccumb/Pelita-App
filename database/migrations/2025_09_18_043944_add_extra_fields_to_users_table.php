<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'no_ktp')) {
                $table->string('no_ktp')->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('users', 'kelurahan')) {
                $table->string('kelurahan')->nullable()->after('no_ktp');
            }
            if (!Schema::hasColumn('users', 'kecamatan')) {
                $table->string('kecamatan')->nullable()->after('kelurahan');
            }
            if (!Schema::hasColumn('users', 'kabupaten')) {
                $table->string('kabupaten')->nullable()->after('kecamatan');
            }
            if (!Schema::hasColumn('users', 'kode_pos')) {
                $table->string('kode_pos')->nullable()->after('kabupaten');
            }
            if (!Schema::hasColumn('users', 'nama_organisasi')) {
                $table->string('nama_organisasi')->nullable()->after('instansi');
            }
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'no_ktp',
                'kelurahan',
                'kecamatan',
                'kabupaten',
                'kode_pos',
                'nama_organisasi',
            ]);
        });
    }
};
