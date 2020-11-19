<?php

namespace App\Imports;

use App\department;
use Maatwebsite\Excel\Concerns\ToModel;

class dept_import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new department([
            "dept_name"=>$row[1],
            "admin_uuid"=>$row[2],
            "dept_id"=>$row[3],
            "dept_head"=>$row[4],
        ]);
    }
}
