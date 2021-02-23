<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lead_follower extends Model
{
    public function user(){
        return $this->belongsTo(User::class,"follower_id","id");
    }
}
