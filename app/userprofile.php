<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userprofile extends Model
{
    public function agent(){
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function assign_agent(){
        return $this->hasMany(assign_ticket::class);
    }
}
