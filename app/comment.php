<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    public function ticket()
    {
        return $this->belongsTo(ticket::class);
    }

    /**
     * A comment belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
