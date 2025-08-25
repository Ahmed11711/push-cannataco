<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasTranslations;
    protected $fillable = [
        'title',
        'description',
        'icon',
        'image',
        'image_alt',
    ];
    public $translatable = [
        'title',
        'description'
    ];
      public function seo()
    {
        return $this->morphOne(\App\Models\Seo::class, 'model');
    }

}
