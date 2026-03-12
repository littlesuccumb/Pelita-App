<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_aset', ['barang','ruangan']);
            $table->unsignedBigInteger('aset_id');
            $table->dateTime('tanggal')->nullable();
            $table->text('deskripsi')->nullable();
            $table->decimal('biaya', 14, 2)->default(0);
            $table->string('teknisi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('maintenance');
    }
};
