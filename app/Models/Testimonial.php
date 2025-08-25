<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
        use HasTranslations;

    protected $fillable  = [
        'title',
        'description',
        'image',
    ]; 

  public $translatable =[   
      'title',
      'description',
  ];
  
}
