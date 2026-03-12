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
        Schema::table('permohonan', function (Blueprint $table) {
            // Field untuk kop surat
            $table->string('kop_surat')->nullable()->after('alamat_instansi');
            
            // Field untuk draft surat yang digenerate otomatis
            $table->string('draft_surat')->nullable()->after('kop_surat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonan', function (Blueprint $table) {
            $table->dropColumn(['kop_surat', 'draft_surat']);
        });
    }
};