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
        Schema::create('ujian_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->unsignedBigInteger('id_ujian');
            $table->timestamp('waktu_mulai')->nullable()->default(null);
            $table->timestamp('waktu_selesai')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_ujian')->references('id')->on('ujian_penjalurans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujian_mahasiswas');
    }
};
