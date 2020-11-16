<?php

namespace App\Imports;

use App\employee;
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
            'id'=>$row[0],
            'employee_id'=>$row[1],
            'dob'=>$row[2],
            'join_date'=>$row[3],
            'address'=>$row[4],
            'report_to'=>$row[5],
            'dept_id'=>$row[6],
            'emp_id'=>$row[7],
            'phone'=>$row[8],
            'dept_head'=>$row[9],
            'company_id'=>$row[10],
            'emp_post'=>$row[11],
            'admin_id'=>$row[12],
        ]);
    }
}
