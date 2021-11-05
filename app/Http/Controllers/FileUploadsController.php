<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\FileUploads;
use App\User;
use App\Candidate;

class FileUploadsController extends Controller
{
    public function all_entries(){

        $sessions = FileUploads::orderBy('created_at', 'desc')->paginate(6);
        if($sessions->isEmpty()){
            return redirect()->back();
        }else{
            $cand_id = $sessions->pluck('candidate_id');
            $lubbish = Candidate::where('id', $cand_id)->get()->pluck('name','phone');
            //dd($lubbish);
            foreach ($lubbish as $phone => $name) {
                return view('entries.all_records')->with('sessions', $sessions)
                                        ->with('name', $name)
                                        ->with('phone', $phone);
            }
        }
    }




    public function saveBlob(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            
            'interview_id'=>'required',
            'candidate_id'=>'required',
            // 'group_id'    =>'required',
            'video-blob'  => 'required|file|mimetypes:video/webm|max:800000'
        ]);

        if ($request->has('video-blob')) {
            $name = Str::random(4).time().$request->file('video-blob')->getClientOriginalName();
            $extension = $request->file('video-blob')->getClientOriginalExtension();
            $destination = public_path().'/InterviewSessions';
            $path='/InterviewSessions/'.$name;
            $request->file('video-blob')->move($destination, $name);
            $fileNameToStore = $path;
        }
    
            $blob = new FileUploads;
            $blob->interview_id = $request->interview_id;
            $blob->candidate_id = $request->candidate_id;
            $blob->video_blob   = $fileNameToStore;

        if($blob->save()){
            return response()->json(['success_info' => 'Your entry was recieved']);
        }

    }


}
