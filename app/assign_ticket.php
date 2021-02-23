<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assign_ticket extends Model
{
    public function ticket(){
        return $this->belongsTo(ticket::class,'ticket_id',"id");
    }
    public function agent(){
        return $this->belongsTo(User::class,"agent_id","id");
    }
    public function employee(){
        return $this->belongsTo(user_employee::class,"agent_id","user_id");
    }
}
