<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('karyawans_id')->unsigned();
            $table->bigInteger('jadwalaktif_id')->unsigned();
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->string('kode');
            $table->timestamps();

            $table->foreign('karyawans_id')->references('id')->on('karyawans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jadwalaktif_id')->references('id')->on('jadwalaktif_karyawans')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensis');
    }
}
