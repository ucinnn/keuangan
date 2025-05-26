<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Run the migrations. */
    public function up(): void
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();

            // ─── Relasi utama ───────────────────────────────────────────
            $table->unsignedBigInteger('siswa_id');            // FK → siswas.id
            $table->unsignedBigInteger('idjenispembayaran');   // FK → jenispembayaran.idjenispembayaran
            $table->unsignedBigInteger('id_tahunajaran');      // FK → tahunajaran.id

            // ─── Detail tagihan ────────────────────────────────────────
            $table->enum('bulan', [
                'Januari','Februari','Maret','April','Mei','Juni',
                'Juli','Agustus','September','Oktober','November','Desember'
            ]);                                // atau tinyInteger 1‑12 sesuai kebutuhan
            $table->bigInteger('nominal');     // nominal tagihan (boleh override default)
            $table->enum('status', ['lunas','belum'])->default('belum');
            $table->date('tanggal_bayar')->nullable();         // terisi ketika lunas

            $table->timestamps();

            // ─── Foreign‑key constraint ───────────────────────────────
            $table->foreign('siswa_id')
                  ->references('id')->on('siswas')
                  ->onDelete('cascade');

            $table->foreign('idjenispembayaran')
                  ->references('idjenispembayaran')->on('jenispembayaran')
                  ->onDelete('cascade');

            $table->foreign('id_tahunajaran')
                  ->references('id')->on('tahunajaran')
                  ->onDelete('cascade');
        });
    }

    /** Reverse the migrations. */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
