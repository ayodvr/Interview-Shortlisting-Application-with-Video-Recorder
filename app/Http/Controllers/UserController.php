<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Candidate;
use Spatie\Permission\Models\Role;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Exports\CandidateTemplateExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'asc')->get();
        return view('users.index')->with('users', $users);
    }

    public function dashboard()
    {
        $auth = auth()->user()->id;
        $clients = User::role('client')->count();
        $candidates = Candidate::where('user_id', $auth)->count();
        $cand_count = Candidate::all()->count();
        $groups = Group::where('user_id', $auth)->count();
        $adgroups = Group::all()->count();
        return view('index')->with('clients', $clients)
                                  ->with('candidates', $candidates)
                                  ->with('groups', $groups)
                                  ->with('adgroups', $adgroups)
                                  ->with('cand_count', $cand_count);
    }

    public function realUniqId()
    { 
        $myuuid = uniqid();
        return $myuuid;
    }

    public function importTemplate(){

        Excel::import(new UsersImport, request()->file('file'));
        return back()->with('success', 'Users uploaded successfully');
    }

    public function upload()
    {
        $groups = Group::all();
        return view('candidates.upload')->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        $roles = Role::where('name', '!=', 'admin')->get();
        //dd($roles);

        return view('users.create')->with('roles',$roles)
                                    ->with('groups',$groups);
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'role' => 'required',
            'image' => 'nullable',
            'group_id' => ['numeric']
        ]);


        $password = Str::random(6);

        $data = [
            'name'=> $request->get('name'),
            'email'=> $request->get('email'),
            'phone'=> $request->get('phone'),
            // 'role'=> $request->get('role'),
            'password'=> Hash::make($password),
            'uuid'=> $this->realUniqId(),
            'image'=> $request->get('image'),
            'group_id' => $request->get('group_id')
        ];
        
        if ($request->has('image')) {
            $name = time().$request->file('image')->getClientOriginalName();
            $destination = public_path().'/CandidatesImages';
            $path='/CandidatesImages/'.$name;
            $request->file('image')->move($destination, $name);
            $data['image'] = $path;
        }

        //dd($data);

        $result = User::create($data);

        foreach ($request->role as $key => $value) {
            $role = Role::find($value);
            $result->assignRole($role->name);
        }

        // $Role::where('name', 'candidate')->get();

        // dd($Role);
        // Candidate::create($Role);

        return redirect()->back()->with('success','Users created successfully');

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
        $user = User::find($id);
        $roles = Role::where('name', '!=', 'admin')->get();
        $groups = Group::all();
        return view('users.edit')->with('user',$user)
                                    ->with('roles',$roles)
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

        $user = User::find($id);

        $user->update($data);

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('role'));

        return redirect()->route('users.index')->with('success','User updated successfully');
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

    public function kill($id)
    {
        $user = User::findorfail($id);

        $user->delete();

        return redirect()->back()->with('success','User deleted successfully');
    }

        public function downloadCandidateTemplate()
    {
        return Excel::download(new CandidateTemplateExport(), 'Candidate.xlsx');
    }

}
