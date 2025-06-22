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
        Schema::dropIfExists('polis');
        Schema::dropIfExists('daftar_polis');
        Schema::dropIfExists('jadwal_periksas');

        Schema::create('polis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_poli', 25);
            $table->text('keterangan');
            $table->enum('is_active', ['true', 'false'])->default('true');

        });

        Schema::create('jadwal_periksas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokter');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->time('jam_mulai', 0);
            $table->time('jam_selesai', 0);

        });

        Schema::create('daftar_polis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_jadwal');
            $table->text('keluhan');
            $table->unsignedInteger('no_antrian');

            $table->foreign('id_pasien')->references('id')->on('users');
            $table->foreign('id_jadwal')->references('id')->on('jadwal_periksas');
        });

        Schema::table('dokters', function (Blueprint $table) {

            $table->unsignedBigInteger('id_poli');
            
            $table->foreign('id_poli')->references('id')->on('polis');
        });

        Schema::table('periksas', function (Blueprint $table) {

            $table->dropColumn('id_daftar_polis');

            $table->unsignedBigInteger('id_daftar_polis')->nullable();
            // $table->dropForeign('periksas_id_pasien_foreign');
            // $table->dropForeign('periksas_id_dokter_foreign');

            // $table->dropColumn('id_pasien');
            // $table->dropColumn('id_dokter');

            $table->foreign('id_daftar_polis')->references('id')->on('daftar_polis');
        });

        Schema::table('obats', function (Blueprint $table) {
            $table->enum('is_active', ['true', 'false'])->default('true');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polis');
        Schema::dropIfExists('jadwal_periksas');
        Schema::dropIfExists('daftar_polis');

        Schema::dropColumns('dokters', ['id_poli']);
        Schema::dropColumns('periksas', ['id_daftar_polis']);
        Schema::dropColumns('obats', ['is_active']);
    }
};
