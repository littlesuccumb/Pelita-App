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
        Schema::table('log_aktivitas', function (Blueprint $table) {
            // Tambahkan kolom tipe (aktivitas atau notifikasi)
            $table->enum('tipe', ['aktivitas', 'notifikasi'])
                  ->default('aktivitas')
                  ->after('user_id')
                  ->comment('Tipe: aktivitas untuk log biasa, notifikasi untuk notifikasi user');
            
            // Tambahkan kolom URL untuk redirect notifikasi
            $table->string('url')->nullable()->after('detail');
            
            // Tambahkan kolom status baca
            $table->boolean('is_read')->default(false)->after('url');
            
            // Tambahkan kolom waktu dibaca
            $table->timestamp('read_at')->nullable()->after('is_read');
            
            // Tambahkan index untuk performa query
            $table->index(['user_id', 'tipe', 'is_read'], 'idx_user_tipe_read');
            $table->index('created_at', 'idx_created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('log_aktivitas', function (Blueprint $table) {
            // Drop indexes
            $table->dropIndex('idx_user_tipe_read');
            $table->dropIndex('idx_created_at');
            
            // Drop columns
            $table->dropColumn(['tipe', 'url', 'is_read', 'read_at']);
        });
    }
};