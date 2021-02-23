<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class deal extends Model
{
    public function customer_company(){
        return $this->belongsTo(customerCompany::class,"org_name","id");
    }
    public function customer(){
        return $this->belongsTo(customer::class,"contact","id");
    }
    public function employee(){
        return $this->belongsTo(employee::class,"assign_to","id");
    }
}
