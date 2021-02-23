<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    public function ticket(){
        return $this->hasMany(ticket::class);
    }
}
