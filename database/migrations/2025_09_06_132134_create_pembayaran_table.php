<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjaman')->onDelete('cascade');
            $table->enum('metode', ['cash', 'transfer', 'gratis'])->nullable()->default(null);
            $table->decimal('jumlah', 14, 2)->default(0);
            $table->enum('status', ['pending','lunas','batal'])->default('pending');
            $table->string('bukti_transfer')->nullable();
            $table->dateTime('tanggal_bayar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
