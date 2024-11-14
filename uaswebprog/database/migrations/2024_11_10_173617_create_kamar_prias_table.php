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
            // $table->string('foto')->nullable();
            $table->integer('tipe_kamar');
            $table->string('email')->unique()->nullable();
            $table->string('full_name')->unique()->nullable();
            $table->boolean('is_reserved')->nullable()->default(0);;
            $table->foreign('tipe_kamar')->references('tipe_kamar')->on('tipe_kamars')->onDelete('cascade');
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
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
