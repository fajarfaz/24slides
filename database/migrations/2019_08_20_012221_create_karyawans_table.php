<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('karyawans');
        Schema::create('karyawans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama',80);
            $table->string('nama_panggilan',30);
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('level_id')->unsigned();
            $table->string('jabatan',50);
            $table->string('nik',11);
            $table->bigInteger('status_id')->unsigned();
            $table->date('tanggal_training'); 
            $table->date('tanggal_masuk'); 
            $table->date('tanggal_keluar');
            $table->longText('alamat_ktp');
            $table->longText('alamat_tinggal');
            $table->string('no_telp',16);
            $table->date('tanggal_lahir');
            $table->string('usia',16);
            $table->string('no_ktp',16);
            $table->string('no_npwp',15);
            $table->string('klasifikasi_pajak',3);
            $table->string('kpj_bpjs',11);
            $table->string('bpjs_kesehatan',11);
            $table->string('no_rek',13);
            $table->string('jenis_kelamin',1);
            $table->string('status_nikah',2);
            $table->integer('jumlah_anak');
            $table->string('jenjang_pendidikan',10);
            $table->text('asal_sekolah');
            $table->text('jurusan');
            $table->date('tanggal_masuk_pendidikan'); 
            $table->date('tanggal_keluar_pendidikan');
            $table->string('golongan_darah',2);
            $table->string('nama_kerabat',80);
            $table->string('notelp_kerabat',16);
            $table->text('benefit_karyawan');
            $table->string('base_salary');
            $table->integer('quota_cuti');
            $table->integer('sisa_quota_cuti')->default(0);
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levelings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status_karyawans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
}
