<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    protected $fillable = ["user_id", "value"];

    public function appraisers()
    {
        return $this->morphTo();
    }

    public function recipient()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
