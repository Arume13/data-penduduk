<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPendudukTable extends Migration
{
    public function up()
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->boolean('ibu_hamil')->default(false);
            $table->boolean('ibu_menyusui')->default(false);
            $table->boolean('berkebutuhan_khusus')->default(false);
            $table->string('keterangan_khusus')->nullable();
        });
    }

    public function down()
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropColumn(['ibu_hamil', 'ibu_menyusui', 'berkebutuhan_khusus', 'keterangan_khusus']);
        });
    }
}
