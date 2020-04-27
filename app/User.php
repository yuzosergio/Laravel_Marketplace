<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     /*Defina quais dados pode ser inserido pelo routes "create"*/ 
    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

     /*faz com que não exiba o campo password no json*/
    protected $hidden = [
        'password', 'remember_token'
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function store(){
        return  $this->hasOne(Store::class);
    }

    public function orders(){
        return $this->hasMany(UserOrder::class);
    }

    
}
