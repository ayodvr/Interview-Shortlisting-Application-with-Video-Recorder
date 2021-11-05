<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Alert;
use App\User;
use App\Group;
use App\Candidate;
use App\Exports\GroupTemplateExport;
use App\Imports\GroupsImport;
use Maatwebsite\Excel\Facades\Excel;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::orderBy('created_at', 'desc')->withCount('candidates')->get();
        return view('groups.index')->with('groups', $groups);
    }

    public function clients_grp()
    {
        $user = auth()->user()->id;
        $groups = Group::where('user_id', $user)->withCount('candidates')->get();
        //dd($groups);
        return view('groups.clients')->with('groups', $groups);
    }

    public function importTemplate(){

        Excel::import(new GroupsImport, request()->file('file'));
        return back()->with('success', 'Groups uploaded successfully');
    }

    public function downloadGroupTemplate()
    {
        return Excel::download(new GroupTemplateExport(), 'Group.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user()->id;
        return view('groups.create')->with('user',$user);
    }

    public function upload()
    {
        $groups = Group::all();
        return view('groups.upload')->with('groups',$groups);
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

            'name' => 'required'
        ]);


        $data = [
            'name'=> $request->get('name'),
            'user_id' => auth()->user()->id,
        ];

        Group::create($data);

        return redirect()->back()->withSuccess('Group Created!');
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
        $group = Group::find($id);

	    return response()->json([
	      'data' => $group
	    ]);
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
        Group::updateOrCreate(['id' => $id],['name' => $request->name]);
     
        return response()->json([ 'success' => true ]);
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
        $group = Group::findorfail($id);

        $group->delete();

        return redirect()->back()->withSuccess('Group Deleted!');
    }

    public function group_users($group_name = null)
    {
        $groups = Candidate::orderBy('created_at','desc')->where('group_id', $group_name)->get();
        //dd($groups);
        return view("groups.all_users")->with('groups',$groups)
                                        ->with("group_id",$group_name);
    }
}
