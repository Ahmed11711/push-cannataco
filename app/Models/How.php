<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class How extends Model
{
    use HasTranslations;
    protected $fillable = [
        'title',
        'content',
       
    ];
    public $translatable = [
        'title',
        'content'
    ];
}
