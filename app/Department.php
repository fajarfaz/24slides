<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $fillable = [
        'name', 'users_id'
    ];
    public function leader()
    {
    	return $this->belongsTo(User::class,'users_id');
    }
}
