<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $table = 'makanans';
    protected $fillable = [
        'name', 'harga'
    ];
}
