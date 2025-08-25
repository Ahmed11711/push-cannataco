<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Why;

class WhiesSeeder extends Seeder
{
    public function run(): void
    {
        Why::create([
            'name' => [
                'en' => 'Fast Service',
                'ar' => 'خدمة سريعة'
            ],
            'description' => [
                'en' => 'We deliver your projects on time with high quality.',
                'ar' => 'نقوم بتسليم المشاريع في الوقت المحدد وبجودة عالية.'
            ],
            'image' => 'whies/fast-service.png',
        ]);

        Why::create([
            'name' => [
                'en' => 'Technical Support',
                'ar' => 'دعم فني متواصل'
            ],
            'description' => [
                'en' => '24/7 customer and technical support available.',
                'ar' => 'دعم فني وخدمة عملاء متوفرة 24/7.'
            ],
            'image' => 'whies/support.png',
        ]);
    }
}
