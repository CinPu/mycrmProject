<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class leadModel extends Model
{
    public function customer(){
        return $this->belongsTo(customer::class,"customer_id","id");
    }
    public function saleMan(){
        return $this->belongsTo(employee::class,"sale_man_id","id");
    }
    public function tags(){
        return $this->belongsTo(tags_industry::class,"tags_id","id");
    }
}
