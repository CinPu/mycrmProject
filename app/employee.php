<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'id',
        'name',
        'email',
        'employee_id',
        'dob',
        'join_date',
        'address',
        'report_to',
        'dept_id',
        'nrc',
        'gender',
        'nationality',
        'religion',
        'marital_status',
        'phone',
        'dept_head',
        'company_id',
        'emp_post',
        'admin_id',
    ];
    public function employee_user(){
        return $this->belongsTo(User::class,"emp_id","id");
    }
    public function report_to_user(){
        return $this->belongsTo(User::class,"report_to","id");
    }
    public function admin(){
        return $this->belongsTo(User::class,"admin_id","id");
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
    public function dept(){
        return $this->belongsTo(department::class,"dept_id","id");
    }
    public function emp_user(){
        return $this->hasMany(user_employee::class);
    }
}
