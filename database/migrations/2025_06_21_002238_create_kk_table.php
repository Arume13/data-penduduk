<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kk', function (Blueprint $table) {
            $table->id();
            $table->string('noKK')->unique();
            $table->string('kepalaKeluarga');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('noRumah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kk');
    }
};
