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
        Schema::create('kamar_pria', function (Blueprint $table) {
            $table->char('nomor_kamar', 2)->primary();
            $table->foreignId('id_user')->nullable()->unique()->onDelete('cascade');
            $table->unsignedBigInteger('tipe_kamar');
            // $table->string('foto')->nullable();
            // $table->unsignedBigInteger('id_user')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar_pria');
    }
};
