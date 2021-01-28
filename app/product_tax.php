<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_tax extends Model
{
    public function product(){
        return $this->hasMany(product::class);
    }
}
