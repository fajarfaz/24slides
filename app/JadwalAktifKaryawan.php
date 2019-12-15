<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class JadwalAktifKaryawan extends Model
{
    protected $table = 'jadwalaktif_karyawans';
    protected $fillable = [
        'tanggal', 'id_jadwal','id_karyawan','take_meal'
    ];
    public function aktif()
    {
    	return $this->belongsTo(JadwalShift::class,'id_jadwal');
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class,'id_karyawan');
    }
    public function absen()
    {
        return $this->hasOne(Absensi::class,'jadwalaktif_id');
    }
}