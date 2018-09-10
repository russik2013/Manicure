<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriprionLaws extends Model
{
    protected $fillable = ['subscriptions_id', 'laws_id'];

    public function lawInfo()
    {
        return $this->belongsTo(Laws::class, 'laws_id', 'id');
    }
}
