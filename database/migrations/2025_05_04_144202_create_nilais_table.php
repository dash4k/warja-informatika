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
            $table->float('etika_profesi');
            $table->float('kewarganegaraan');
            $table->float('bahasa_indonesia');
            $table->float('matematika_diskrit_1');
            $table->float('statistika_dasar');
            $table->float('algoritma_pemrograman');
            $table->float('sistem_digital');
            $table->float('matematika_informatika');
            $table->float('pancasila');
            $table->float('pendidikan_agama');
            $table->float('matematika_diskrit_2');
            $table->float('pengantar_probabilitas');
            $table->float('kewirausahaan');
            $table->float('tata_tulis_karya_ilmiah');
            $table->float('struktur_data');
            $table->float('sistem_operasi');
            $table->float('organisasi_arsitektur_komputer');
            $table->float('interaksi_manusia_komputer');
            $table->float('basis_data');
            $table->float('desain_analisis_algoritma');
            $table->float('rekayasa_perangkat_lunak');
            $table->float('pemrograman_berbasis_obyek');
            $table->float('komunikasi_data_jaringan_komputer');
            $table->float('teori_bahasa_otomata');
            $table->timestamps();

            $table->foreign('id_nilai')->references('nim')->on('mahasiswas')->onDelete('cascade');
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
