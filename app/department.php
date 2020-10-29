<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    public function agent(){
        return $this->hasMany(agent::class);
    }
    public  function assign_with_dept(){
        return $this->hasMany(assignwithdept::class);
    }
    public function employee(){
        return $this->hasMany(employee::class);
    }
    public function department_head(){
        return $this->belongsTo(User::class,"dept_head","id");
    }
}
