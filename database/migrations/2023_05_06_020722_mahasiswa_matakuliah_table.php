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
        Schema::create('mahasiswa_mata_kuliah', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_Nim');
            $table->unsignedBigInteger('mata_kuliah_id');
            $table->foreign('mahasiswa_Nim')->references('Nim')->on('mahasiswas');
            $table->foreign('mata_kuliah_id')->references('id')->on('matakuliah');
            $table->string('nilai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_mata_kuliah');
    }
};
