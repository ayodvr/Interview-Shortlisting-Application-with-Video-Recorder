<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    
    protected $fillable = [
        'name', 'email','image','uuid','phone','group_id','user_id'
    ];

    public function groups(){
        return $this->belongTo('App\Group');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }
}
