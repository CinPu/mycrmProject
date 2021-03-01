<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    public function customer_position(){
        return $this->belongsTo(position::class,'position',"id");
    }
    public function customer_company(){
        return $this->belongsTo(company::class,'company_id',"id");
    }
    public function user(){
        return $this->belongsTo(User::class,"admin_id","id");
    }
    public function lead(){
        return $this->hasMany(leadModel::class);
    }
    public function deal(){
        return $this->hasMany(deal::class);
    }
}
