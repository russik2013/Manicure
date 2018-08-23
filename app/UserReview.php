<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    protected $fillable = ['client_id', 'comment'];

    public function getRating()
    {
        return $this->morphOne(UserRating::class, 'appraisers');
    }

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'client_id');
    }
}
