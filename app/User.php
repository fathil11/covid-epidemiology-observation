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
    protected $fillable = [
        'name', 'email', 'phone' , 'instance', 'instance_place', 'role','password',
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

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function isAdmin()
    {
        return $this->role == 1;
    }

    public function isLab()
    {
        return $this->role == 2;
    }

    public function isPe()
    {
        return $this->role == 3;
    }

    public function isSecondPe()
    {
        return $this->role == 4;
    }

    public function isReviewer()
    {
        return $this->role == 5;
    }

}
