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
        Schema::create('transkrip_nilais', function (Blueprint $table) {
            $table->id('id_transkrip');
            $table->binary('khs_semester_1')->nullable();
            $table->binary('khs_semester_2')->nullable();
            $table->binary('khs_semester_3')->nullable();
            $table->binary('transkrip_sementara')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('id_nilai')->unique();

            $table->foreign('id_nilai')->references('id_nilai')->on('nilais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transkrip_nilais');
    }
};
