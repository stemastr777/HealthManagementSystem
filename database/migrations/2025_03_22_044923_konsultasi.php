<?php

use Illuminate\Database\Eloquent\Scope;
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
        
        $conn = Schema::connection('consultation');

        $conn->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('alamat', 255)->nullable();
            $table->string('no_hp', 50)->unique();
            $table->string('email', 50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['pasien', 'dokter'])->default('pasien');
            $table->string('remember_token');
            $table->timestamps();
        });

        $conn->create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat', 50);
            $table->string('kemasan', 35);
            $table->integer('harga');
            $table->timestamps();
        });

        $conn->create('periksas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_dokter');
            $table->dateTime('tgl_periksa');
            $table->text('catatan');
            $table->integer('biaya_periksa')->default(0);
            $table->timestamps();

            $table->foreign('id_pasien')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id')->on('users')->onDelete('cascade');
        });

        $conn->create('detail_periksas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_periksa');
            $table->unsignedBigInteger('id_obat');
            $table->timestamps();

            $table->foreign('id_periksa')->references('id')->on('periksas')->onDelete('cascade');
            $table->foreign('id_obat')->references('id')->on('obats')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        $conn = Schema::connection('consultation');

        $conn->drop('detail_periksas');
        $conn->drop('periksas');
        $conn->drop('users');
        $conn->drop('obats');
    }
};
