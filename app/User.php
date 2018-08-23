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
    public function areas()
    {
        return $this->hasMany(UserArea::class);
    }

    public function setAgeAttribute($value)
    {
        $this->attributes['age'] = (Carbon::now())->diffInMonths($value)/12;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function rating()
    {
        return $this->hasMany(UserRating::class);
    }

    public function avgRating()
    {
        return $this->rating()
            ->selectRaw('avg(value) as aggregate, user_id')
            ->groupBy('user_id');
    }

    public function getAvgRatingAttribute()
    {
        if ( ! array_key_exists('avgRating', $this->relations)) {
            $this->load('avgRating');
        }

        $relation = $this->getRelation('avgRating')->first();

        return ($relation) ? $relation->aggregate : null;
    }

    public function getRating()
    {
        return $this->morphMany(UserRating::class, 'appraisers');
    }

    public function getReview()
    {
        return $this->hasMany(UserReview::class, 'client_id');
    }

    public function userReviews()
    {
        //return $this->belongsToMany(UserReview::class,'user_ratings')->using(UserRating::class);

        return $this->hasMany(UserRating::class)
            ->where('appraisers_type', '=', 'App\UserReview');
    }

    public function getFullNameAttribute()
    {
        return "{$this->firstName} {$this->lastName}";
    }
}
