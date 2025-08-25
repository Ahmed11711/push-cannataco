<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'sender_type',
        'receiver_id',
        'receiver_type',
        'is_seen',
        'content'
    ];

    public function sender(): MorphTo
    {
        return $this->morphTo();
    }

    public function receiver(): MorphTo
    {
        return $this->morphTo();
    }
    
}
