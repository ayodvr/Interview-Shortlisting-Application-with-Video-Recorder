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
        $candidates = Candidate::orderBy('created_at', 'desc')->get();
        return view('candidates.index')->with('candidates', $candidates);
    }

    public function adminCands()
    {
        $auth = auth()->user()->id;
        $candidates = Candidate::where('user_id', $auth)->get();
        //dd($candidates);
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
        $roles = Role::where('name', '=', 'candidate')->get();
        return view('candidates.create')->with('groups',$groups)
                                         ->with('roles', $roles);
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
            // 'role'  => 'required',
            'phone' => 'required',
            'image' => 'nullable',
            'group_id' => ['required', 'numeric']
        ]);
        
        $data = [
            'name'=> $request->get('name'),
            'user_id'=> auth()->user()->id,
            'email'=> $request->get('email'),
            'phone'=> $request->get('phone'),
            'image'=> $request->get('image'),
            'uuid'=> $this->realUniqId(),
            'group_id' => $request['group_id']

        ];

        //dd($data);

        if ($request->has('image')) {
            $name = time().$request->file('image')->getClientOriginalName();
            $destination = public_path().'/CandidatesImages';
            $path='/CandidatesImages/'.$name;
            $request->file('image')->move($destination, $name);
            $data['image'] = $path;
        }

        //dd($data);

        $result = Candidate::create($data);

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
        $candidate = Candidate::find($id);
        $groups = Group::all();
        return view('candidates.edit')->with('candidate', $candidate)
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
        $data = $request->except(['_method','_token']);

        $candidate = Candidate::find($id);

        $candidate->update($data);

        return redirect()->route('candidates.index')->with('success','Candidate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function kill($id)
    {
        $candidate = Candidate::findorfail($id);

        $candidate->delete();

        return redirect()->back()->withSuccess('Candidate Deleted!');
    }

    public function destroy($id)
    {
        //
    }
}
