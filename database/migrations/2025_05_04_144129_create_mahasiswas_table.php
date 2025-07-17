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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama');
            $table->enum('kelas', ['a', 'b', 'c', 'd', 'e', 'f']);
            $table->string('profile_picture');
            $table->boolean('validated')->default(false);
            $table->timestamp('validated_at')->nullable()->default(null);
            $table->string('id_admin')->nullable()->default(null);
            $table->string('admin_notes')->nullable()->default(null);
            $table->timestamps();
            
            $table->foreign('nim')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
