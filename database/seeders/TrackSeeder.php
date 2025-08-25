<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Track;
use App\Models\ShippingMethod;

class TrackSeeder extends Seeder
{
    public function run(): void
    {
        // مثال: إنشاء 3 مسارات (Track) مع طريقة شحن لكل واحد
        for ($i = 1; $i <= 3; $i++) {
            $track = Track::create([
                'country_sender_id' => 1,
                'state_sender_id' => 1,
                'city_sender_id' => 1,
                'country_reseved_id' => 2,
                'state_reseved_id' => 2,
                'city_reseved_id' => 2,
            ]);

            ShippingMethod::create([
                'track_id' => $track->id,
                'type' => 'air',
                'price' => rand(5, 20),
            ]);
        }
    }
}
