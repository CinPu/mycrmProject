<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assignwithdept extends Model
{
    public function ticket(){
        return $this->belongsTo(ticket::class,"ticket_id","id");
    }
    public function dept(){
        return $this->belongsTo(department::class,"dept_id","id");
    }
}
