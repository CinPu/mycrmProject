<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticketFollower extends Model
{
    public function emp(){
        return $this->belongsTo(User::class,"emp_id","id");
    }
    public function followintTicket(){
        return $this->belongsTo(ticket::class,"ticket_id","id");
    }
}
