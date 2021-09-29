<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{

    protected $fillable = [
        'interview_id', 'question'
    ];
    
    public function fileuploads(){
        return $this->belongsTO('App\FileUploads');
    }
}
