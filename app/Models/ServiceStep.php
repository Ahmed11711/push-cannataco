<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ServiceStep extends Model
{
    use HasTranslations;
    protected $fillable = [
        'service_id',
        'name',
        'image',
    ];

    public $translatable = ['title'];

}
