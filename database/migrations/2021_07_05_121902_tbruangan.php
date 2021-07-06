<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tbruangan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ruangans', function (Blueprint $table) {
            $table->string('kode_gedung')->primary();
            $table->string('nama_gedung');
            $table->string('nama_ruangan');
            $table->string('kode_ruangan');
            $table->string('pic');

            $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('ruangans');
    }
};
