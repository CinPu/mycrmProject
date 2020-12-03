<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    public function customer_position(){
        return $this->belongsTo(position::class,'position',"id");
    }
    public function customer_company(){
        return $this->belongsTo(customerCompany::class,'company_id',"id");
    }
    public function user(){
        return $this->belongsTo(User::class,"admin_id","id");
    }
}
