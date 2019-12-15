<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leveling extends Model
{
    protected $table = 'levelings';
    protected $fillable = [
        'name', 
    ];
}
