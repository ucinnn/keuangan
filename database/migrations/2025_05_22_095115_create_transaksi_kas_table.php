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
        Schema::create('transaksi_kas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kas_id')->constrained('kas')->onDelete('cascade'); // Relasi dengan kas
            $table->decimal('nominal', 15, 2);
            $table->text('keterangan')->nullable();
            $table->foreignId('unitpendidikan_id')->constrained('unitpendidikan')->onDelete('cascade');
            $table->string('username');
            $table->foreign('username')->references('username')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_kas', function (Blueprint $table) {
            $table->dropSoftDeletes(); // menghapus kolom deleted_at jika rollback
        });
    }
};
