<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLemburTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembur', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('karyawans_id')->unsigned();
            $table->datetime('mulai_lembur');
            $table->datetime('selesai_lembur');
            $table->Integer('durasi');
            $table->string('detail');
            $table->string('status',10)->default('New Entry');
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
        Schema::dropIfExists('lembur');
    }
}
