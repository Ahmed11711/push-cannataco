<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Seo extends Model
{
    use HasTranslations;
       protected $fillable = [
        'model_type',
        'model_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'meta_robots',
        'og_image',
    ];
    public $translatable = [
        'meta_title',
    ];

    public function model()
    {
        return $this->morphTo();
    }

}
