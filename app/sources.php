<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sources extends Model
{
    public function ticket(){
        return $this->hasMany(ticket::class);
    }
}
