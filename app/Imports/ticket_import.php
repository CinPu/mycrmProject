<?php

namespace App\Imports;

use App\ticket;
use App\user_information;
use Maatwebsite\Excel\Concerns\ToModel;

class ticket_import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
//        dd($row);
        user_information::create([
            "id"=>$row[6],
          "name"=>$row[1],
            'admin_id'=>$row[2],
            "email"=>$row[3],
        ]);
        ticket:: create([
            'user_id'=>$row[4],
            'ticket_id'=>$row[5],
            'userinfo_id'=>$row[6],
            'phone'=>$row[7],
            'message'=>$row[8],
            'title'=>$row[9],
            'status'=>$row[10],
            'case_type'=>$row[11],
            'product'=>$row[12],
            'priority'=>$row[13],
            'photo'=>$row[14],
            'source'=>$row[15],
            'isassign'=>$row[16],
            'lat'=>$row[17],
            'lng'=>$row[18],

        ]);
    }
}
