<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $table = 'mutasi';
    protected $fillable = [
        'karyawans_id', 'status', 'tanggal', 'adjustments'
    ];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class,'karyawans_id');
    }
}
