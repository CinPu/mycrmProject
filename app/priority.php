<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class priority extends Model
{
    public function ticket(){
        return $this->hasMany(ticket::class);
    }
}
