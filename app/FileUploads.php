<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileUploads extends Model
{
    
    protected $fillable = [
        'file', 'group_id', 'user_id', 'interview_id'
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
