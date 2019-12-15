<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalOff extends Model
{
    protected $table = 'jadwal_off';
    protected $dates = ['tanggal_mulai','tanggal_selesai'];
    protected $fillable = [
        'karyawans_id', 'status', 'tanggal_mulai', 'tanggal_selesai', 'durasi','jenis'
    ];
    public function karyawan()
    {
    	return $this->belongsTo(Karyawan::class,'karyawans_id');
    }
}
