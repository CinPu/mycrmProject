<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class solvedTime extends Model
{
    public function ticket(){
        return $this->belongsTo(ticket::class,"ticket_id","id");
    }
    public function priority_type(){
        return $this->belongsTo(priority::class,"priority","id");
    }
}
