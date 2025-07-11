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
            $table->enum('jalur', ['j1', 'j2', 'j3', 'j4', 'j5', 'j6', 'j7', 'j8', 'j9']);
            $table->enum('action', ['editable', 'locked'])->default('locked');
            $table->boolean('validated')->default(false);
            $table->timestamp('validated_at')->nullable()->default(null);
            $table->unsignedBigInteger('id_admin')->nullable()->default(null);
            $table->string('admin_notes')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('set null');
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
