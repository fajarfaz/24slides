<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenguranganGajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurangan_gajis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('karyawans_id')->unsigned();
            $table->bigInteger('gaji_id')->unsigned()->nullable();
            $table->float('nominal')->default(0);
            $table->string('detail');
            $table->timestamps();


            $table->foreign('karyawans_id')->references('id')->on('karyawans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('gaji_id')->references('id')->on('gaji')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengurangan_gajis');
    }
}
