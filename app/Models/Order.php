<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'merchant_id',
        'track_id',
        'total_amount',
        'serial_number',
        'status',
        'name_sender',
        'phone_sender',
        'address_sender',
        'email_sender',
        'name_received',
        'phone_received',
        'email_received',
        'delivered_at'
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
