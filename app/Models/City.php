<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'state_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function tracksSent()
    {
        return $this->hasMany(Track::class, 'city_sender_id');
    }

    public function tracksReceived()
    {
        return $this->hasMany(Track::class, 'city_reseved_id');
    }
}
