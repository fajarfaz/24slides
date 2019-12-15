<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangeShiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_shift', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('shift_awal')->unsigned();
            $table->bigInteger('shift_ganti')->unsigned();
            $table->integer('tanggal');
            $table->bigInteger('karyawans_id')->unsigned();
            $table->bigInteger('id_pengganti')->unsigned();
            $table->boolean('approve')->default(false);
            $table->timestamps();


            $table->foreign('shift_awal')->references('id')->on('jadwal_shift')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('shift_ganti')->references('id')->on('jadwal_shift')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('karyawans_id')->references('id')->on('karyawans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_pengganti')->references('id')->on('karyawans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('change_shift');
    }
}
