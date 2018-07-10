<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;




class User extends Authenticatable
{
   
    use Notifiable;
    protected $table = "users";
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email','id_card','gender','birt_date','university','faculty','major','image','role','type', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
}
