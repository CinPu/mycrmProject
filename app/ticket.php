<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function comment()
    {
        return $this->hasMany(comment::class);
    }
    public function cases(){
        return $this->belongsTo(case_type::class,'case_type','id');
    }
    public function status_type(){
        return $this->belongsTo(status::class,'status','id');
    }
    public function sources_type(){
        return $this->belongsTo(sources::class,'source','id');
    }
    public function assingticket(){
        return $this->hasMany(assign_ticket::class);
    }
    public function assigndept(){
        return $this->hasMany(assigntodepartment::class);
    }
    public function priority_type(){
        return $this->belongsTo(priority::class,"priority","id");
    }
    public function userinfo(){
        return $this->belongsTo(user_information::class,"userinfo_id","id");
    }
    public function solveTime(){
        return $this->hasMany(solvedTime::class);
    }
}
