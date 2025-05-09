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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->float('agama');
            $table->float('sisdig');
            $table->float('statdas');
            $table->float('matinfor');
            $table->float('strukdat');
            $table->float('kdjk');
            $table->float('tbo');
            $table->float('daa');
            $table->float('rpl');
            $table->float('sisop');
            $table->float('oak');
            $table->float('pbo');
            $table->float('kwu');
            $table->float('matdis_2');
            $table->float('etprof');
            $table->float('ttki');
            $table->float('basindo');
            $table->float('matdis_1');
            $table->float('kwn');
            $table->float('imk');
            $table->float('basdat');
            $table->float('probabil');
            $table->float('alpro');
            $table->float('pancasila');
            $table->unsignedBigInteger('id_nilai_total');

            $table->foreign('id_nilai_total')->references('id_nilai_total')->on('nilai_totals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
