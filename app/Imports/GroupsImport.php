<?php

namespace App\Imports;

use App\Group;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GroupsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = auth()->user();

        return new Group([
            
        'name'  => $row['name'],
        'user_id'=> $user->id

    ]);
    }
}
