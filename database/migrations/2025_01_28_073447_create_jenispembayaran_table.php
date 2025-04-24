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
        Schema::create('jenispembayaran', function (Blueprint $table) {
            $table->id('idjenispembayaran');
            $table->string('nama_pembayaran', 255);
            $table->enum('type', ['Bulanan', 'Semester', 'Tahunan', 'Bebas']);
            // $table->year('tahun');
            $table->bigInteger('nominal_jenispembayaran');
            $table->enum('status', ['Aktif', 'Non Aktif']);
            $table->unsignedBigInteger('idunitpendidikan');
            $table->unsignedBigInteger('id_tahunajaran');
            
            
            $table->foreign('idunitpendidikan')->references('id')->on('unitpendidikan')->onUpdate('cascade')->onDelete('cascade');;
            $table->foreign('id_tahunajaran')->references('id')->on('tahunajaran')->onUpdate('cascade')->onDelete('cascade');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenispembayaran');
    }
};