<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = ['user_id', 'role_id',];

    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function roleInfo()
    {
        return $this->belongsTo(Role::class,'role_id');
    }
}
