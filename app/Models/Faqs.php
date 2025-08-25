<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
 use HasTranslations;
    protected $fillable = [
        'key',
        'value',
    ];
        public $translatable = ['key', 'value'];

}