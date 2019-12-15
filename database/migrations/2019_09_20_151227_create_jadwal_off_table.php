<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalOffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_off', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('karyawans_id')->unsigned();
            $table->datetime('tanggal_mulai');
            $table->datetime('tanggal_selesai');
            $table->string('jenis');
            $table->integer('durasi');
            $table->string('status');
            $table->boolean('approve')->default(false);
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
        Schema::dropIfExists('jadwal_off');
    }
}
