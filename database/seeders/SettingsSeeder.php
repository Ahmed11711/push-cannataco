<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
   public function run(): void
    {
       $setting= Setting::create([
            'logo' => 'settings/logo.png',
            'phone' => '+201000000000',
            'phone_two' => '+201122222222',
            'email' => 'info@example.com',
            'email_two' => 'support@example.com',
            'address' => 'Cairo, Egypt',
            'working_hours' => [
                'en' => 'Sat - Thu: 9AM - 5PM',
                'ar' => 'السبت - الخميس: 9 صباحًا - 5 مساءً'
            ],
            'facebook' => 'https://facebook.com/example',
            'twitter' => 'https://twitter.com/example',
            'instagram' => 'https://instagram.com/example',
            'youtube' => 'https://youtube.com/example',
        ]);
        $setting->locations()->create([
        'name' => [
            'en' => 'Our History',
            'ar' => 'تاريخنا'
        ],
        'latitude' => 30.0444,
        'longitude' => 31.2357,
    ]);
    }
}
