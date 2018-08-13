<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verificationCode', 'city', 'firstName', 'lastName', 'age'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne(UserRole::class);
    }

    public function setAgeAttribute($value)
    {
        $this->attributes['age'] = (Carbon::now())->diffInMonths($value)/12;
    }

    public function serPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
