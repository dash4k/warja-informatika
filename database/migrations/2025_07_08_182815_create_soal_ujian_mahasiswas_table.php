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
        Schema::create('soal_ujian_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ujian_mahasiswa');
            $table->unsignedBigInteger('id_soal');
            $table->string('id_jalur');
            $table->timestamps();

            $table->foreign('id_ujian_mahasiswa')->references('id')->on('ujian_mahasiswas')->onDelete('cascade');
            $table->foreign('id_soal')->references('id')->on('soal_penjalurans')->onDelete('cascade');
            $table->foreign('id_jalur')->references('id_jalur')->on('jalurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_ujian_mahasiswas');
    }
};
