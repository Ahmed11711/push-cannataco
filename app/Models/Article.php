<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    use HasTranslations;
    protected $fillable = [
        'title',
        'content',
        'slug',
        'image',
        'image_alt',
        'is_published',
    ];

    public $translatable = ['title', 'content'];
    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'is_published' => 'boolean',
    ];

public function getRouteKeyName()
{
    return 'slug';
}
  public function seo()
    {
        return $this->morphOne(\App\Models\Seo::class, 'model');
    }
}
