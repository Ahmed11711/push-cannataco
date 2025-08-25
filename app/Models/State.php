<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function tracksSent()
    {
        return $this->hasMany(Track::class, 'state_sender_id');
    }

    public function tracksReceived()
    {
        return $this->hasMany(Track::class, 'state_reseved_id');
    }
}
