<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidate;
use App\Group;
use App\User;
use App\Imports\CandidatesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = User::orderBy('created_at', 'desc')->get();
        return view('candidates.index')->with('candidates', $candidates);
    }

    public function realUniqId()
    {
        $myuuid = uniqid();
        return $myuuid;
    }

    public function importTemplate(Request $request){

        Excel::import(new CandidatesImport, request()->file('file'));
        return back()->with('success', 'Candidates uploaded successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        return view('candidates.create')->with('groups',$groups);
    }

    public function upload()
    {
        $groups = Group::all();
        return view('candidates.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'nullable',
            // 'role' => 'required',
            'group_id' => ['required', 'numeric']
        ]);

        // $password = Str::random(6);

        //dd($request->all());
        $data = [
            'name'=> $request->get('name'),
            'email'=> $request->get('email'),
            'phone'=> $request->get('phone'),
            'image'=> $request->get('image'),
            // 'role'=> $request->get('role'),
            // 'password'=> Hash::make($password),
            'uuid'=> $this->realUniqId(),
            'group_id' => $request['group_id']

        ];

        if ($request->has('image')) {
            $name = time().$request->file('image')->getClientOriginalName();
            $destination = public_path().'/CandidatesImages';
            $path='/CandidatesImages/'.$name;
            $request->file('image')->move($destination, $name);
            $data['image'] = $path;
        }

        //dd($data);

        $result = Candidate::create($data);

        // $result->assignRole('candidate');

    
        return redirect()->back()->with('success','Candidate created successfully');

        // if(User::create($data)){

        //     $email = $data['email'];
        //     $details = [
        //         'name' => $data['name'],
        //         'email'=> $data['email'],
        //         'password' => $password
        //     ];

        //     //dd($details['password']);
        //     Mail::to($email)->send(new UserCredentials($details));

            

        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
