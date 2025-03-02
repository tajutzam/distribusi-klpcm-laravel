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
        Schema::create('klpcm_detail', function (Blueprint $table) {
            $table->id();
            $table->boolean('no_rm')->default(false);
            $table->boolean('nama')->default(false);
            $table->boolean('jenis_kelamin')->default(false);
            $table->boolean('tanggal_lahir')->default(false);
            $table->boolean('umur')->default(false);
            $table->boolean('alamat')->default(false);
            $table->boolean('pendidikan')->default(false);
            $table->boolean('agama')->default(false);
            $table->boolean('diagnosa_utama')->default(false);
            $table->boolean('nama_terang')->default(false);
            $table->boolean('identifikasi')->default(false);
            $table->boolean('diagnosis')->default(false);
            $table->boolean('pembetulan_kesalahan')->default(false);
            $table->string('kode_wilayah');
            $table->string('nama_string');
            $table->string('keperluan');
            $table->string('poli');
            $table->string('nama_peminjam');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->string('no_wa');
            $table->enum('status_kembali', ['kembali', 'belum-kembali'])->default('belum-kembali');
            $table->enum('status_lengkap', ['lengkap', 'belum-lengkap'])->default('belum-lengkap');
            $table->foreignId('klpcm_id')->references('id')->on('klpcm')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klpcm_detail');
    }
};
