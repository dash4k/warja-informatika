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
        Schema::create('nilai_totals', function (Blueprint $table) {
            $table->id('id_nilai_total');
            $table->float('nilai_total');
            $table->unsignedBigInteger('nim');

            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_totals');
    }
};
