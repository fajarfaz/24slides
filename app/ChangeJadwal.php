<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeJadwal extends Model
{
    protected $table = 'change_shift';
    protected $fillable = [
        'tanggal','shift_awal', 'shift_ganti', 'karyawans_id','id_pengganti', 'approve',
    ];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class,'karyawans_id');
    }
    public function karyawan_pengganti()
    {
        return $this->belongsTo(Karyawan::class,'id_pengganti');
    }
    public function jadwal_awal()
    {
        return $this->belongsTo(JadwalShift::class,'shift_awal');
    }
    public function jadwal_baru()
    {
        return $this->belongsTo(JadwalShift::class,'shift_ganti');
    }
}
