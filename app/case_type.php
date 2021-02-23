<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class case_type extends Model
{
    public function ticket(){
        return $this->hasMany(ticket::class);
    }
}
