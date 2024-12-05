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
        Schema::create('guests', function (Blueprint $table) {
            $table->id('id_guest');
            $table->unsignedBigInteger('id_user');
            $table->string('guest_name');
            $table->char('nomor_kamar', 2);
            $table->enum('gender', ['L', 'P']);
            $table->integer('guest_amount');
            $table->date('visit_date');
            $table->date('end_date');
            $table->string('relation');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
