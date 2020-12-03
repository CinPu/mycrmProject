<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','uuid',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function agent(){
        return $this->hasMany(agent::class);
    }
    public function ticket(){
        return $this->hasMany(ticket::class);
    }
    public function comment()
    {
        return $this->hasMany(comment::class);
    }
    public function assignticket(){
        return $this->hasMany(assign_ticket::class);
    }
    public function employee(){
        return $this->hasMany(employee::class);
    }
    public function report_to(){
        return $this->hasMany(employee::class);
    }
    public function dept_head(){
        return $this->hasMany(department::class);
    }
    public function follower(){
        return $this->hasMany(ticketFollower::class);
    }
    public function company(){
        return $this->hasMany(company::class);
    }
    public function emp_user(){
        return $this->hasMany(user_employee::class);
    }
    public function customer(){
        return $this->hasMany(customer::class);
    }
}
