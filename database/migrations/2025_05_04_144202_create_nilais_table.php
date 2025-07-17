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
            $table->string('id_nilai')->primary();
            $table->float('etika_profesi')->default(0);
            $table->float('kewarganegaraan')->default(0);
            $table->float('bahasa_indonesia')->default(0);
            $table->float('matematika_diskrit_1')->default(0);
            $table->float('statistika_dasar')->default(0);
            $table->float('algoritma_pemrograman')->default(0);
            $table->float('sistem_digital')->default(0);
            $table->float('matematika_informatika')->default(0);
            $table->float('pancasila')->default(0);
            $table->float('pendidikan_agama')->default(0);
            $table->float('matematika_diskrit_2')->default(0);
            $table->float('pengantar_probabilitas')->default(0);
            $table->float('kewirausahaan')->default(0);
            $table->float('tata_tulis_karya_ilmiah')->default(0);
            $table->float('struktur_data')->default(0);
            $table->float('sistem_operasi')->default(0);
            $table->float('organisasi_arsitektur_komputer')->default(0);
            $table->float('interaksi_manusia_komputer')->default(0);
            $table->float('basis_data')->default(0);
            $table->float('desain_analisis_algoritma')->default(0);
            $table->float('rekayasa_perangkat_lunak')->default(0);
            $table->float('pemrograman_berorientasi_obyek')->default(0);
            $table->float('komunikasi_data_jaringan_komputer')->default(0);
            $table->float('teori_bahasa_otomata')->default(0);
            $table->string('transkrip_sementara')->default('');
            $table->boolean('validated')->default(false);
            $table->timestamp('validated_at')->nullable()->default(null);
            $table->string('id_admin')->nullable()->default(null);
            $table->string('admin_notes')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('id_nilai')->references('nim')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('set null');
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
