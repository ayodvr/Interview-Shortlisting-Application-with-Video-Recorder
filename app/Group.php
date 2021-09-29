<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name','user_id'
    ];

    public function users(){
        return $this->hasMany('App\User');
    }

    public function candidates(){
        return $this->hasMany('App\Candidate');
    }

    // public function interviews(){
    //     return $this->hasMany('App\Interview');
    // }

    public function fileuploads(){
        return $this->belongsTo('App\FileUploads');
    }
}
