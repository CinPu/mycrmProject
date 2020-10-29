<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class position extends Model
{
    public function employee(){
        return $this->hasMany(employee::class);
    }
}
