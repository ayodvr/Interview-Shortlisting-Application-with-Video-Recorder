<?php

namespace App\Imports;

use App\Candidate;
use App\Group;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CandidatesImport implements ToModel, WithHeadingRow
{

    // public function __construct($group_id)
    // {
    //     $this->group_id = $group_id;
    // }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Candidate([

            'name'      => $row['name'],
            'email'     => $row['email'],
            'phone'     => $row['phone'],
            'uuid'     => $this->realUniqId(),
        ]);
    }

    public function realUniqId()
    { 
        $myuuid = uniqid();
        return $myuuid;
    }

}
