<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensis';
    protected $fillable = [
        'karyawans_id', 'jadwalaktif_id', 'jam_masuk', 'jam_keluar', 'kode'
    ];

    public function karyawan()
    {
    	return $this->belongsTo(Karyawan::class,'karyawans_id');
    }
    public function jadwal()
    {
    	return $this->belongsTo(JadwalAktifKaryawan::class,'jadwalaktif_id');
    }
}
