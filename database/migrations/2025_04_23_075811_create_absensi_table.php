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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_jadwal');
            $table->unsignedBigInteger('id_makul');
            $table->time('jam');
            $table->date('tanggal');
            $table->point('lokasi')->nullable();
            $table->string('foto');

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id')->on('jadwal')->onDelete('cascade');
            $table->foreign('id_makul')->references('id')->on('makul')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
