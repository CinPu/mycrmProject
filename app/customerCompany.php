<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customerCompany extends Model
{
    protected $fillable=[
    "company_id",
    "name",
    "logo",
    "company_registry",
    "company_mission",
    "company_vision",
    "type_of_business",
    "name_of_ceo",
    "facebookpage",
    "linkedin",
    "parent_company",
    "phone",
    "hotline",
    "email",
    "company_website",
    "company_address",
    "admin_id"
    ];
    public function customer(){
        return $this->hasMany(customer::class);
    }
    public function deal(){
        return $this->hasMany(deal::class);
    }
}
