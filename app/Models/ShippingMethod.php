<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $fillable =[
        'track_id',
        'type',
        'price'
    ];

    public function track()
    {
        return $this->belongsTo(Track::class);
    }
}
