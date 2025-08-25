<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Message;

class Merchant extends Authenticatable implements MustVerifyEmail
{
    use HasTranslations, HasFactory, Notifiable, HasApiTokens, HasRoles;


    protected $fillable = [
        'name',
        'email',
        'password',
        'country',
        'city',
        'state',
        'address_warehouse',
        'address_company',
        'phone',
        'phone2',
        'status',
        'image',
        'description',
        'google_id',
        'facebook_id',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $hidden = ['password', 'remember_token'];

  public function messages()
{
    return $this->morphMany(Message::class, 'sender');
}
    public function latestMessage()
    {
        return $this->hasOne(Message::class, 'id')
            ->where(function ($q) {
                $q->where('sender_id', $this->id)
                    ->orWhere('receiver_id', $this->id);
            })
            ->latestOfMany();
    }
}
