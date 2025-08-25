<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class History extends Model
{
    use HasTranslations;

    protected $fillable = [
        'about_id',
        'title',
        'content',
        'date',
        'image',
    ];

    public $translatable = ['title', 'content'];

    public function about()
    {
        return $this->belongsTo(About::class);
    }
}
