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
        Schema::table('jadwal_periksas', function (Blueprint $table) {
            $table->enum('is_active', ['true', 'false']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('jadwal_periksas', function (Blueprint $table) {
            $table->enum('is_active', ['true', 'false']);
        });
    }
};
