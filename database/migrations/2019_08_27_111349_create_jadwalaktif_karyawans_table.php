<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalaktifKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwalaktif_karyawans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tanggal');
            $table->bigInteger('id_jadwal')->unsigned();
            $table->bigInteger('id_karyawan')->unsigned();
            $table->boolean('take_meal')->default(true);
            $table->timestamps();

            $table->foreign('id_jadwal')->references('id')->on('jadwal_shift')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_karyawan')->references('id')->on('karyawans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwalaktif_karyawans');
    }
}
