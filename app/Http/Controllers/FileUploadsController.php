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
        $auth = auth()->user()->id;
        $sessions = FileUploads::orderBy('created_at', 'desc')->paginate(6);
        $admins = FileUploads::where('client_id', $auth)->paginate(6);
        if($sessions->isEmpty()){
            notify()->error("No record found!","Error");
            return redirect()->back();
        }else{
            $client_id = $sessions->pluck('client_id');
            $lubbish = Candidate::where('user_id', $client_id)->get()->pluck('name','phone');
            //dd($sessions);
            foreach ($lubbish as $phone => $name) {
                return view('entries.all_records')->with('sessions', $sessions)
                                        ->with('name', $name)
                                        ->with('phone', $phone)
                                        ->with('admins', $admins);
            }
        }
    }




    public function saveBlob(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            
            'interview_id'=>'required',
            'candidate_id'=>'required',
            'client_id'    =>'required',
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
            $blob->client_id = $request->client_id;
            $blob->video_blob   = $fileNameToStore;

        if($blob->save()){
            return response()->json(['success_info' => 'Your entry was recieved']);
        }

    }


}
