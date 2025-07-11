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
        Schema::create('jawaban_ujian_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ujian_mahasiswa');
            $table->unsignedBigInteger('id_soal');
            $table->string('jawaban');
            $table->boolean('is_correct');
            $table->timestamps();

            $table->foreign('id_ujian_mahasiswa')->references('id')->on('ujian_mahasiswas')->onDelete('cascade');
            $table->foreign('id_soal')->references('id')->on('soal_ujian_mahasiswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_ujian_mahasiswas');
    }
};
