<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    
    protected $fillable = [
        'name', 'email','image','uuid','phone','group_id'
    ];

    public function groups(){
        return $this->belongsTo('App\Group');
    }

    public function users(){
        return $this->hasMany('App\User');
    }
}
