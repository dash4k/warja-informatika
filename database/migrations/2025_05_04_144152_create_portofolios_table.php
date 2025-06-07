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
        Schema::create('portofolios', function (Blueprint $table) {
            $table->id('id_portofolio');
            $table->unsignedBigInteger('nim');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->string('nama_kegiatan');
            $table->string('tempat_kegiatan');
            $table->string('bukti');
            $table->float('bobot');
            $table->enum('status', ['accepted', 'rejected', 'pending'])->default('pending');
            $table->enum('action', ['editable', 'locked'])->default('editable');
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolios');
    }
};
