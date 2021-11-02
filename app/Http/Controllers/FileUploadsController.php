<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileUploads;

class FileUploadsController extends Controller
{
    public function saveBlob(Request $request)
    {
        dd($request->file);
        
        $data=$request->validate([

            'interview_id'=>'required',
            'user_id'=>'required',
            'file' => 'mimes:webm|max:800000',
        ]);

        if ($request->has('file')) {
            $name = Str::random(4).time().$request->file('video')->getClientOriginalName();
            $destination = public_path().'/LessonUploads';
            $path='/LessonUploads/'.$name;
            $request->file('video')->move($destination, $name);
            $data['video'] =$path;
        }
    }
}
