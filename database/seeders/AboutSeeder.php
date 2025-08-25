<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
  public function run(): void
{
    $about = About::create([
        'about' => [
            'en' => 'We are a leading company in providing digital solutions.',
            'ar' => 'نحن شركة رائدة في تقديم الحلول الرقمية.'
        ],
        'mission' => [
            'en' => 'To deliver innovative and efficient services to our clients.',
            'ar' => 'تقديم خدمات مبتكرة وفعالة لعملائنا.'
        ],
        'vision' => [
            'en' => 'To be the leading provider of digital transformation in the region.',
            'ar' => 'أن نكون المزود الرائد للتحول الرقمي في المنطقة.'
        ]
    ]);

    $about->histories()->create([
        'title' => [
            'en' => 'Our History',
            'ar' => 'تاريخنا'
        ],
        'content' => [
            'en' => 'Founded in 2010, we have grown rapidly in the tech industry.',
            'ar' => 'تأسست الشركة في عام 2010، ونمت بسرعة في مجال التكنولوجيا.'
        ],
        'date' => now()->format('Y-m-d'),
        'image' => 'history.jpg',
    ]);
}
    
}
