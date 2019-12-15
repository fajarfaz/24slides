<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalShift extends Model
{
    protected $table = 'jadwal_shift';
    protected $fillable = [
        'id_makanan', 'name', 'jam_mulai', 'jam_selesai',
    ];
    public function meal()
    {
    	return $this->belongsTo(Meal::class,'id_makanan');
    }
    public function aktif($tanggal)
    {
    	return $this->hasOne(JadwalAktifKaryawan::class,'id_jadwal');
    } 
}
