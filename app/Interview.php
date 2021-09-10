<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable = [

        'title','expire','instruction','number','question','user_id','group_id'
    ];

    public function users(){
        return $this->hasMany('App\User');
    }

    public function groups(){
        return $this->belongsTo('App\Group');
    }
}
