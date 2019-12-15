<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusKaryawan extends Model
{
    protected $table = 'status_karyawans';
    protected $fillable = [
        'name', 
    ];
}
