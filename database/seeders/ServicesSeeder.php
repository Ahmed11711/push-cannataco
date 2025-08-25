<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'title' => [
                'en' => 'Web Development',
                'ar' => 'تطوير المواقع'
            ],
            'description' => [
                'en' => 'We offer modern and scalable web development solutions.',
                'ar' => 'نقدم حلول تطوير مواقع حديثة وقابلة للتوسع.'
            ],
            'icon' => 'fa-solid fa-code',
            'image' => 'services/web-development.jpg',
            'image_alt' => 'Web development service image',
        ]);

        Service::create([
            'title' => [
                'en' => 'Mobile Applications',
                'ar' => 'تطبيقات الموبايل'
            ],
            'description' => [
                'en' => 'High-performance mobile apps tailored to your needs.',
                'ar' => 'تطبيقات موبايل عالية الأداء مخصصة لاحتياجاتك.'
            ],
            'icon' => 'fa-solid fa-mobile-screen',
            'image' => 'services/mobile-apps.jpg',
            'image_alt' => 'Mobile application service image',
        ]);
    }
}
