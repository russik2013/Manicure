<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    protected $fillable= ['name', 'price', 'term'];

    public function laws()
    {
        return $this->hasMany(SubscriprionLaws::class);

    }

}
