<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * 
     */
    // protected $fillable = [
    //     'name', 'username', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * 
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
}
