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
        Schema::create('kamar_perempuan', function (Blueprint $table) {
            $table->char('nomor_kamar', 2)->primary();
            $table->string('foto')->nullable();
            $table->enum('tipe_kamar', ["dalam", "luar"]);
            $table->string('email')->unique()->nullable();
            $table->foreign('tipe_kamar')->references('tipe_kamar')->on('kamar')->onDelete('cascade');
            $table->foreign('email')->references('email')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};