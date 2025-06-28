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
        Schema::create('jumlah_portofolios', function (Blueprint $table) {
            $table->id('nim');
            $table->integer('j1')->default(0);
            $table->integer('j2')->default(0);
            $table->integer('j3')->default(0);
            $table->integer('j4')->default(0);
            $table->integer('j5')->default(0);
            $table->integer('j6')->default(0);
            $table->integer('j7')->default(0);
            $table->integer('j8')->default(0);
            $table->integer('j9')->default(0);
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jumlah_portofolios');
    }
};
