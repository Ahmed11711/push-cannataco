<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;
    protected $fillable = [
        'logo',
        'phone',
        'phone_two',
        'email',
        'email_two',
        'address',
        'working_hours',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
    ];
      public $translatable = [
        'working_hours'
    ];
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

}
