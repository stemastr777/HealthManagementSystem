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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();
            $table->string("no_rm");
            $table->string("no_ktp");

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('dokters', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->enum('is_active', ['true', 'false'])->default('true');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
        Schema::dropIfExists('dokters');
        Schema::dropColumns('users', 'is_active');
    }
};
