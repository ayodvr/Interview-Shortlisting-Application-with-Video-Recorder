<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileUploads;

class FileUploadsController extends Controller
{
    public function saveBlob(Request $request)
    {
        dd($request->all());
        
        $data=$request->validate([
            'interview_id'=>'required',
            'cand_id'=>'required',
            'video-filename' => 'mimes:mp4,mov,ogg,webm,qt|max:800000'
        ]);

        if ($request->has('video-filename')) {
            $name = Str::random(4).time().$request->file('video-filename')->getClientOriginalName();
            $destination = public_path().'/InterviewSessions';
            $path='/InterviewSessions/'.$name;
            $request->file('video-filename')->move($destination, $name);
            $data['video-filename'] =$path;
        }

        if(FileUploads::create($data)){

            return response()->json(['success_info' => 'Your entry was recieved']);
        }
    }
}
