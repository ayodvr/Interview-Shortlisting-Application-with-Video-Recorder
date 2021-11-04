<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUploads extends Model
{
    
    protected $fillable = [
        'video-filename','cand_id', 'interview_id','file'
    ];

    public function groups(){
        return $this->hasMany('App\Group');
    }

    public function interviews(){
        return $this->hasMany('App\Interview');
    }

    public function users(){
        return $this->hasMany('App\User');
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }
}
