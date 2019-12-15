<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJatahMakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jatah_makans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_karyawan')->unsigned();
            $table->bigInteger('id_makanan')->unsigned();
            $table->Integer('total');
            $table->timestamps();


            $table->foreign('id_karyawan')->references('id')->on('karyawans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_makanan')->references('id')->on('makanans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jatah_makans');
    }
}