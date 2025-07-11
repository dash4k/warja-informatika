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
        Schema::create('hasil_penjalurans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nim');
            $table->string('id_jalur')->nullable()->default(null);
            $table->decimal('skor_akhir')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_jalur')->references('id_jalur')->on('jalurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_penjalurans');
    }
};
