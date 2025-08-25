<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
        use HasTranslations;

    protected $fillable = [
        'title',
        'desc',
        'btn_text',
        'btn_link',
        'image',
        'image_alt',
    ]; 

  public $translatable =[   
      'title',
      'desc',
      'btn_text',
  ];
  
}
