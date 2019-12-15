<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'gaji';
    protected $fillable = [
        'karyawans_id', 'penambahan', 'pengurangan', 'total'
    ];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class,'karyawans_id');
    }
    public function penambahan_gaji()
    {
    	return $this->hasMany(PenambahanGaji::class,'gaji_id');
    }
    public function pengurangan_gaji()
    {
    	return $this->hasMany(PenguranganGaji::class,'gaji_id');
    }
}
