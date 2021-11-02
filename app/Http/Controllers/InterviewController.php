<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Interview;
Use App\Group;
Use App\Questions;
use Carbon\Carbon;
use App\Mail\InterviewMail;
use Illuminate\Support\Facades\Session;
use Mail;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user()->id;
        return view('interviews.create')->with('user', $user);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[

            'title' => 'required',
            'expire' => 'required',
            'instruction' => 'required|max:400',
            'number' => 'required',
            'question' => 'required|array'
        ]);

            $questions   = $request->question;


            //
                $interviews = new Interview;
                $interviews->title = $request->title;
                $interviews->expire = $request->expire;
                $interviews->instruction = $request->instruction;
                $interviews->number = $request->number;
                $interviews->question = json_encode($questions);
                $interviews->user_id = auth()->user()->id;
                $interviews->group_id = "";

                $res = $interviews->save();

               if($res) {

                 foreach($questions as $question){
                    //dd($question);
                    $questionObj = new Questions;
                    $questionObj->interview_id = $interviews->id;
                    $questionObj->question = $question;

                    $questionObj->save();
                 }
                 
               }


        return redirect()->route('interview.edit', $interviews->id);

    }

    

    public function session_expire(){

        return view('interviews.session');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function details($id="", $user_id ="")
    {
        $interview = Interview::where('id', $id)->first();
        //dd($interview);
        return view('interviews.details')->with('interview', $interview)
                                        ->with(['id' => $id, 'user_id' => $user_id]);

    }

    // public function show(Request $request, $id)
    // {
    //     //dd($id);
    //     $interview = Interview::findorfail($id);
    //     //dd($interview);

    //     if($interview) $questions = Questions::where("interview_id",$interview->id)->simplePaginate(1);
  
    //     if ($request->ajax()) {
    //         return view('interviews.questions', compact('questions'));
    //     }
      
    //    // return view('ajaxPagination',compact('products'));
    //     $date = strtotime($interview->expire);

    //     $new_date = date("Y-m-d", $date);
    
    //     $now = date("Y-m-d");

    //     if ($now > $new_date) {

    //         return view('interviews.linkExpire');
    //     }
    //     else
    //     {
    //         return view('interviews.show')->with('questions',$questions)
    //                                         ->with('questions',$questions)
    //                                         ->with('interview',$interview);
                                         
    //     }

    // }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $interview = Interview::findorfail($id);
        $user = auth()->user()->id;
        $groups = Group::where('user_id', $user)->withCount('users')->get();
        return view('interviews.edit')->with('interview', $interview)
                                      ->with('groups', $groups);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->file());
        
        $data = [
            'subject'          => $request->get('subject'),
            'email_content'    => $request->get('email_content'),
        ];


        $group_id = $request->only('group_id');

        $interview = Interview::find($id);

       if($interview->update($group_id)){

        $group = $request->get('group_id');

        $emails = User::where('group_id', $group)->pluck('email','id');
        //dd($emails);
        $dispatch_mails = $emails;
    
        foreach($dispatch_mails as $user_id => $email){
                //dd($user_id);
            \Mail::send('emails.interviewMail',array(

                'id'    => $interview->id,
                'user_id' => $user_id,
                'subject' => $request->get('subject'),
                'email_content'  => $request->get('email_content'),

            ),function($message) use ($request, $email)
            {
                $message->to($email);
                $message->subject($request->get('subject'));      
            }); 
            
            }
        }

        return redirect()->route('interview.create')->with('success','Links sent successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function show_interview(Request $request, $id = "", $user_id = "")
    {
        $interview = Interview::findorfail($id);
        if($interview){
            $interview["newuser_id"] = $user_id;
        }
        //dd($interview);

        if($interview) $questions = Questions::where("interview_id", $interview->id)->simplePaginate(1);
    
        if ($request->ajax()) {
            return view('interviews.questions', compact('questions'));
        }
        
        // return view('ajaxPagination',compact('products'));
        $date = strtotime($interview->expire);

        $new_date = date("Y-m-d", $date);
    
        $now = date("Y-m-d");

        if ($now > $new_date) {

            return view('interviews.linkExpire');
        }
        else
        {
            return view('interviews.blob')->with('questions',$questions)
                                            ->with('interview',$interview);
                                            
        }
    }

}
