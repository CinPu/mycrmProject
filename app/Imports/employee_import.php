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
        return new employee([
            'employee_id'=>$row[1],
            'name'=>$row[2],
            'email'=>$row[3],
            'nrc'=>$row[4],
            'gender'=>$row[5],
            'nationality'=>$row[6],
            'religion'=>$row[7],
            'dob'=>$row[8],
            'marital_status'=>$row[9],
            'join_date'=>$row[10],
            'address'=>$row[11],
            'report_to'=>$row[12],
            'dept_id'=>$row[13],
            'phone'=>$row[14],
            'dept_head'=>$row[15],
            'company_id'=>$row[16],
            'emp_post'=>$row[17],
            'admin_id'=>$row[18],
           ]);

    }
}
