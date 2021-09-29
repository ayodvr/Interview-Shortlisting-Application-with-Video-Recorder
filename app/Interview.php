<?php

namespace App;

// use Livewire\Component;
// use Livewire\WithPagination;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{

    // use WithPagination;

    protected $fillable = [

        'title','expire','instruction','number','question','user_id','group_id'
    ];

    public function users(){
        return $this->hasMany('App\User');
    }

    public function groups(){
        return $this->belongsTo('App\Group');
    }

    public function fileuploads(){
        return $this->belongsTo('App\FileUploads');
    }
}
