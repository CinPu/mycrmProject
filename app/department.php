<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    protected $fillable=[
        'dept_name','admin_uuid','dept_id','dept_head'
    ];
    public function agent(){
        return $this->hasMany(agent::class);
    }
    public function employee(){
        return $this->hasMany(employee::class);
    }
    public function department_head(){
        return $this->belongsTo(User::class,"dept_head","id");
    }
    public function emp(){
        return $this->hasMany(employee::class);
    }
    public function assign(){
        return $this->hasMany(assign_ticket::class);
    }
}
