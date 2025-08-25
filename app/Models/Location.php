<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Location extends Model
{
    use HasTranslations;

    protected $fillable = ['setting_id', 'name', 'latitude', 'longitude'];
    public $translatable = ['name'];

    public function setting()
    {
        return $this->belongsTo(Setting::class);
    }
}
