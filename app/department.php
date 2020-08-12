<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    public function agent(){
        return $this->hasMany(agent::class);
    }
}
