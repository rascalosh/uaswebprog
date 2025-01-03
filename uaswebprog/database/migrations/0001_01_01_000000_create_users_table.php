<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->rememberToken();
        //     $table->foreignId('current_team_id')->nullable();
        //     $table->string('profile_photo_path', 2048)->nullable();
        //     $table->timestamps();
        // });

        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->boolean('is_admin')->default(false);
            $table->string('name');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->enum('gender', ['L', 'P']);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_telp', 11);
            $table->boolean('is_reserving')->default(FALSE);
            $table->boolean('has_room')->default(FALSE);
            // $table->char('reserving_room', 2)->nullable();
            $table->date('tanggal_masuk')->default(date("Y-m-d H:i:s"));
            // $table->integer('nomor_kamar');
            $table->timestamp('deadline_bayar')->nullable();
            $table->rememberToken();
            $table->timestamps();
            // $table->foreign('reserving_room')->references('nomor_kamar')->on('kamar_pria')->onDelete('cascade');
            // $table->foreign('nomor_kamar')->references('nomor_kamar')->on('kamar')->onDelete('cascade')->default(0);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
