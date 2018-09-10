<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laws extends Model
{
    protected $fillable = ['name', 'routes'];

    protected $casts = [];

    public function getRoutesAttribute($value)
    {
        return json_decode(stripslashes($value), true);
    }
}
