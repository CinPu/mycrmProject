<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_information extends Model
{
    protected $fillable = [
        'name','email','admin_id'
    ];
    public function ticket(){
        return $this->hasMany(ticket::class);
    }
}
