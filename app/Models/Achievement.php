<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Achievement extends Model
{
    use HasTranslations;
    protected $fillable = ['name', 'icon', 'count'];
    public $translatable = ['name'];
}
