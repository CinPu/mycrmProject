<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tags_industry extends Model
{
    protected $fillable=['tag_industry'];
    public function lead(){
        return $this->hasMany(leadModel::class);
    }
}
