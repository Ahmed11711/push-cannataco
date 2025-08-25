<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['code', 'name', 'phonecode'];

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function tracksSent()
    {
        return $this->hasMany(Track::class, 'country_sender_id');
    }

    public function tracksReceived()
    {
        return $this->hasMany(Track::class, 'country_reseved_id');
    }
}
