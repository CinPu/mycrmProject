<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_information extends Model
{
    public function ticket(){
        return $this->hasMany(ticket::class);
    }
}
