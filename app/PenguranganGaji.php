<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenguranganGaji extends Model
{
    protected $table = 'pengurangan_gajis';
    protected $fillable = [
        'karyawans_id', 'nominal', 'detail','gaji_id'
    ];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class,'karyawans_id');
    }
    public function gaji()
    {
        return $this->belongsTo(Gaji::class,'gaji_id');
    }
}
