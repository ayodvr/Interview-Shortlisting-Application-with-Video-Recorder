<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Group;
use App\User;
use App\Imports\CandidatesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

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

    function importTemplate(Request $request){

        $this->validate($request, [
            'file' => 'required|file|mimes:xls,xlsx',
            'group_id' => 'required'
        ]);

        $the_file = $request->file('file');
        try{
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range( 2, $row_limit );
            $column_range = range( 'F', $column_limit );
            $startcount = 2;
            $data = array();
            foreach ( $row_range as $row ) {
                $data[] = [
                    'Name'     => $sheet->getCell( 'A' . $row )->getValue(),
                    'email'    => $sheet->getCell( 'B' . $row )->getValue(),
                    'phone'    => $sheet->getCell( 'C' . $row )->getValue(),
                    'uuid'     => $this->realUniqId(),
                    'user_id'  => auth()->user()->id,
                    'group_id' => $request['group_id'],
                    'image'    => 'none.jpg'
                ];
                $startcount++;
            }
            DB::table('candidates')->insert($data);

        } catch (Exception $e) {
            $error_code = $e->errorInfo[1];
            notify()->error("Candidates not uploaded!","Fail");
            return back();
        }
            notify()->success("Candidates uploaded!","Success");
            return back();
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
        notify()->success("Candidate created !","Success");
        return redirect()->back();

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

        notify()->success("Candidate updated !","Success");
        return redirect()->route('candidates.index');
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

        notify()->success("Candidate deleted !","Success");
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
