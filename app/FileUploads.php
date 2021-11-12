<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUploads extends Model
{

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

    public function candidates(){
        return $this->belongsTo('App\Candidate','candidate_id','id');
    }
}
