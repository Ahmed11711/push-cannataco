<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialsSeeder extends Seeder
{
    public function run(): void
    {
        Testimonial::create([
            'title' => [
                'en' => 'Ahmed Ali',
                'ar' => 'أحمد علي'
            ],
            'description' => [
                'en' => 'The team provided excellent service and delivered our website on time!',
                'ar' => 'قدم الفريق خدمة ممتازة وسلموا موقعنا في الوقت المحدد!'
            ],
            'image' => 'testimonials/ahmed.jpg',
        ]);

        Testimonial::create([
            'title' => [
                'en' => 'Sara Mohamed',
                'ar' => 'سارة محمد'
            ],
            'description' => [
                'en' => 'I highly recommend them for any tech-related project!',
                'ar' => 'أنصح بهم بشدة لأي مشروع تقني!'
            ],
            'image' => 'testimonials/sara.jpg',
        ]);
    }
}
