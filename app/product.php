<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public function category(){
        return $this->belongsTo(product_category::class,"cat_id","id");
    }
    public function taxes(){
        return $this->belongsTo(product_tax::class,"tax","id");
    }
}
