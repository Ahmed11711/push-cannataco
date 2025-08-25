<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'country_sender_id',
        'state_sender_id',
        'city_sender_id',
        'country_reseved_id',
        'state_reseved_id',
        'city_reseved_id',
    ];

    public function countrySender()
    {
        return $this->belongsTo(Country::class, 'country_sender_id');
    }

    public function stateSender()
    {
        return $this->belongsTo(State::class, 'state_sender_id');
    }

    public function citySender()
    {
        return $this->belongsTo(City::class, 'city_sender_id');
    }

    public function countryReceived()
    {
        return $this->belongsTo(Country::class, 'country_reseved_id');
    }

    public function stateReceived()
    {
        return $this->belongsTo(State::class, 'state_reseved_id');
    }

    public function cityReceived()
    {
        return $this->belongsTo(City::class, 'city_reseved_id');
    }
   public function shippingMethods()
{
    return $this->hasMany(ShippingMethod::class, 'track_id');
}
}
