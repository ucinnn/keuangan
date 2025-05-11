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
        Schema::create('tuunits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreign('name')->references('name')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('tuunit'); // Menyimpan ID dari unitpendidikan
            $table->foreign('role')->references('peran_user')->on('role')->onUpdate('restrict')->onDelete('restrict');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuunit');
    }
};