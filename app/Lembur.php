<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    protected $table = 'lembur';
    protected $fillable = [
        'karyawans_id', 'mulai_lembur', 'selesai_lembur', 'durasi', 'detail', 'status', 'approve'
    ];
    protected $attributes = [
       'approve' => 0,
    ];
    protected $dates = ['mulai_lembur','selesai_lembur'];
    public function karyawan()
    {
    	return $this->belongsTo(Karyawan::class,'karyawans_id');
    }
}
