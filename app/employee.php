<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    public function employee_user(){
        return $this->belongsTo(User::class,"emp_id","id");
    }
    public function report_to_user(){
        return $this->belongsTo(User::class,"report_to","id");
    }
    public function department(){
        return $this->belongsTo(department::class,"dept_id","id");
    }
    public function company(){
        return $this->belongsTo(company::class,"company_id","id");
    }
    public function position(){
        return $this->belongsTo(position::class,"emp_post","id");
    }
}
