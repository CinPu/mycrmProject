<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_employee extends Model
{
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function employee(){
        return $this->belongsTo(employee::class,"emp_id","id");
    }
    public function assigntiket(){
        return $this->hasMany(assign_ticket::class);
    }
}
