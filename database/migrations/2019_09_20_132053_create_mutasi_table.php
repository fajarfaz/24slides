<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMutasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('karyawans_id')->unsigned();
            $table->string('status',10);
            $table->date('tanggal');
            $table->string('adjustments');
            $table->timestamps();

            $table->foreign('karyawans_id')->references('id')->on('karyawans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mutasi');
    }
}
