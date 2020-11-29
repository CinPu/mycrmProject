<?php

namespace App\Imports;

use App\cusstomerCompany;
use App\customerCompany;
use Maatwebsite\Excel\Concerns\ToModel;

class companyimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new customerCompany([
            "company_id"=>$row[1],
            "name"=>$row[2],
            "company_registry"=>$row[4],
            "company_mission"=>$row[5],
            "company_vision"=>$row[6],
            "type_of_business"=>$row[7],
            "name_of_ceo"=>$row[8],
            "facebookpage"=>$row[9],
            "linkedin"=>$row[10],
            "parent_company"=>$row[11],
            "phone"=>$row[12],
            "hotline"=>$row[13],
            "email"=>$row[14],
            "company_website"=>$row[15],
            "company_address"=>$row[16],
            "admin_id"=>$row[17],
        ]);
    }
}
