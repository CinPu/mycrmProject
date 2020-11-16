<?php

namespace App\Imports;

use App\ticket;
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
        return new ticket([
            'id'=>$row[0],
            'user_id'=>$row[1],
            'ticket_id'=>$row[2],
            'userinfo_id'=>$row[3],
            'phone'=>$row[4],
            'message'=>$row[5],
            'title'=>$row[6],
            'status'=>$row[7],
            'case_type'=>$row[8],
            'product'=>$row[9],
            'priority'=>$row[10],
            'photo'=>$row[11],
            'source'=>$row[12],
            'isassign'=>$row[13],
            'lat'=>$row[14],
            'lng'=>$row[15],

        ]);
    }
}
