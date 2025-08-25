<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SlidersSeeder extends Seeder
{
    public function run(): void
    {
        Slider::create([
            'title' => [
                'en' => 'Build Your Website with Us',
                'ar' => 'ابنِ موقعك معنا'
            ],
            'desc' => [
                'en' => 'We provide modern and scalable web solutions.',
                'ar' => 'نقدم حلول ويب حديثة وقابلة للتوسع.'
            ],
            'btn_text' => [
                'en' => 'Get Started',
                'ar' => 'ابدأ الآن'
            ],
            'btn_link' => '/contact',
            'image' => 'sliders/slider1.jpg',
            'image_alt' => 'Homepage slider image',
        ]);

        Slider::create([
            'title' => [
                'en' => 'Custom Mobile Applications',
                'ar' => 'تطبيقات موبايل مخصصة'
            ],
            'desc' => [
                'en' => 'High-performance apps tailored to your needs.',
                'ar' => 'تطبيقات عالية الأداء تناسب احتياجاتك.'
            ],
            'btn_text' => [
                'en' => 'Learn More',
                'ar' => 'اعرف المزيد'
            ],
            'btn_link' => '/services',
            'image' => 'sliders/slider2.jpg',
            'image_alt' => 'Mobile apps slider image',
        ]);
    }
}
