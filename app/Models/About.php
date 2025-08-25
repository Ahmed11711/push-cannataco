<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasTranslations;
    protected $fillable = [
        'about',
        'mission',
        'vision',
    ];
    public $translatable = [ 'mission', 'vision','about'];
    
   public function histories()
{
    return $this->hasMany(History::class);
}
  public function seo()
    {
        return $this->morphOne(\App\Models\Seo::class, 'model');
    }
}
