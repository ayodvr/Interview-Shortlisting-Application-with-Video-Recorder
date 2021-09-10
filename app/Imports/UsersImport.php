<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// use Maatwebsite\Excel\Concerns\WithBatchInserts;
// use Maatwebsite\Excel\Concerns\WithChunkReading;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $request = request()->all();

        $password = Str::random(6);

        $user = User::create([

            'name'      => $row['name'],
            // 'image'     => $row['image'],
            'email'     => $row['email'],
            'phone'     => $row['phone'],
            'group_id'  => $request['group_id'],
            'password'  => Hash::make($password),
            'uuid'     => $this->realUniqId(),

        ])->assignRole('candidate');


    }

        public function realUniqId()
        { 
            $myuuid = uniqid();
            return $myuuid;
        }
}
