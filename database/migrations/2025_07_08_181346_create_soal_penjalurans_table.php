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
        Schema::create('soal_penjalurans', function (Blueprint $table) {
            $table->id();
            $table->string('id_jalur');
            $table->string('pertanyaan');
            $table->json('pilihan');
            $table->string('jawaban');
            $table->timestamps();

            $table->foreign('id_jalur')->references('id_jalur')->on('jalurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_penjalurans');
    }
};
