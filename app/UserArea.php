<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserArea extends Model
{
    public function userInfo()
    {
        return $this->belongsToMany(User::class, 'user_id');
    }

    public function areaInfo()
    {
        return $this->belongsToMany(Role::class,'role_id');
    }
}
