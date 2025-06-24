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
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('noKK');
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('tempatLahir');
            $table->date('tanggalLahir');
            $table->string('jenisKelamin');
            $table->string('pekerjaan');
            $table->string('kategori');
            $table->string('statusPerkawinan');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('noRumah');
            $table->timestamps();
            $table->foreign('noKK')->references('noKK')->on('kk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
