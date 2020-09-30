<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

//model - SINGULAR!!!!!!!!!!!!!!!!!!
//table - PLURAL
//caso não for seguir a regra acima, declara uma protected $table="nome_table"


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // IMPLEMENTS - jwt
    function getJWTIdentifier(){
        return $this->getKey();
    }

    function getJWTCustomClaims(){
        return [];
    }
}
