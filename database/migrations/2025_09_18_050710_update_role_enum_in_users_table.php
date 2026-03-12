<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('users', function (Blueprint $table) {
            // ubah enum role, tambahkan pengurus_aset
            $table->enum('role', ['user','admin','super_admin','pengurus_aset'])
                  ->default('user')
                  ->change();
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            // rollback ke role lama
            $table->enum('role', ['user','admin','super_admin'])
                  ->default('user')
                  ->change();
        });
    }
};
