<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Interview;
Use App\Group;
use Carbon\Carbon;
use App\Mail\InterviewMail;
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
            'instruction' => 'required',
            'number' => 'required',
            'question' => 'required|array'
        ]);

            $question   = $request->question;

            $interviews = new Interview;
            $interviews->title = $request->title;
            $interviews->expire = $request->expire;
            $interviews->instruction = $request->instruction;
            $interviews->number = $request->number;
            $interviews->question = json_encode($question);
            $interviews->user_id = auth()->user()->id;
            $interviews->group_id = "";

            $interviews->save();


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
    public function show($id)
    {

        $interview = Interview::findorfail($id);

        $questions = json_decode($interview['question']);

        //dd($questions);

        $date = strtotime($interview->expire);

        $new_date = date("Y-m-d", $date);
    
        $now = date("Y-m-d");

        if ($now > $new_date) {

            return view('interviews.linkExpire');
        }
        else
        {
            return view('interviews.show')->with('questions', $questions);
        }

    }

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
        
        $data = [
            'subject'=> $request->get('subject'),
            'email_content'=> $request->get('email_content'),
        ];

        $group_id = $request->only('group_id');

        $interview = Interview::find($id);

       if($interview->update($group_id)){

        $group = $request->get('group_id');

        $emails = User::where('group_id', $group)->pluck('email');
      

    $dispatch_mails = $emails;
    
        foreach($dispatch_mails as $email){

            \Mail::send('emails.interviewMail',array(

                'id'    => $interview->id,
                'subject' => $request->get('subject'),
                'content'  => $request->get('content'),

            ), function($message) use ($email){

                $message->to($email)->subject('Test subject');
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
}
