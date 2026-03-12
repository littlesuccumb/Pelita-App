<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('maintenance', function (Blueprint $table) {
            $table->integer('jumlah')->default(1)->after('aset_id')
                ->comment('Jumlah unit yang di-maintenance');
        });
    }

    public function down()
    {
        Schema::table('maintenance', function (Blueprint $table) {
            $table->dropColumn('jumlah');
        });
    }
};
