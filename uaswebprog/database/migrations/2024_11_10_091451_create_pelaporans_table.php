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
        Schema::create('pelaporans', function (Blueprint $table) {
            $table->id('id_pelaporan');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('full_name');
            $table->char('nomor_kamar', 2);
            $table->enum('gender_kamar', ['L', 'P']);
            $table->date('tanggal');
            $table->string('desc_pelaporan');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporans');
    }
};
