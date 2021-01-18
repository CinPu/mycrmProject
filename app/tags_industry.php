<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tags_industry extends Model
{
    public function lead(){
        return $this->hasMany(leadModel::class);
    }
}
