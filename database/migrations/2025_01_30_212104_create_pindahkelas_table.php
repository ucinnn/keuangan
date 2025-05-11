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
        Schema::create('pindahkelas', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('siswa_id');
            // $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            // $table->unsignedBigInteger('siswa_nis');
            // $table->foreign('siswa_nis')->references('nis')->on('siswas')->onDelete('cascade');
            // $table->unsignedBigInteger('siswa_nisn');
            // $table->foreign('siswa_nisn')->references('nisn')->on('siswas')->onDelete('cascade');
            // $table->string('siswa_nama');
            // $table->foreign('siswa_nama')->references('nama')->on('siswas')->onDelete('cascade');
            // $table->unsignedBigInteger('kelas_id');
            // $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            // $table->string('kelas_nama_kelas');
            // $table->foreign('kelas_nama_kelas')->references('nama_kelas')->on('kelas')->onDelete('cascade');
            $table->unsignedBigInteger('idunitpendidikan');
            $table->unsignedBigInteger('idkelas');
            $table->unsignedBigInteger('idsiswa');

            $table->foreign('idunitpendidikan')->references('id')->on('unitpendidikan')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreign('idkelas')->references('id')->on('kelas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idsiswa')->references('id')->on('siswas')->onUpdate('cascade')->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pindahkelas');
    }
};