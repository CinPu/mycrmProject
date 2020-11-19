<?php

namespace App\Imports;

use App\employee;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class employee_import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
           User::create([
               "id"=>$row[11],
              "email"=>$row[1],
              "name"=>$row[2],
              "password"=>Hash::make($row[3]),
               "uuid"=>$row[4]
           ]);
           employee::create([
               'employee_id'=>$row[5],
               'dob'=>$row[6],
               'join_date'=>$row[7],
               'address'=>$row[8],
               'report_to'=>$row[9],
               'dept_id'=>$row[10],
               'emp_id'=>$row[11],
               'phone'=>$row[12],
               'dept_head'=>$row[13],
               'company_id'=>$row[14],
               'emp_post'=>$row[15],
               'admin_id'=>$row[16],
           ]);

    }
}
