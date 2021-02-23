<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agent extends Model
{
    public function user(){
        return $this->belongsTo(User::class,"agent_id","id");
    }
    public function dept(){
        return $this->belongsTo(department::class);
    }
}
