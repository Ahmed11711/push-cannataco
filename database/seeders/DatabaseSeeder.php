<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ServicesSeeder::class,
            AboutSeeder::class,
            AdminsSeeder::class,
            ArticlesSeeder::class,
            ContactsSeeder::class,
            SettingsSeeder::class,
            SlidersSeeder::class,
            TestimonialsSeeder::class,
            WhiesSeeder::class,
            CountriesTableSeeder::class,
            StatesTableSeeder::class,
            CitiesTableSeeder::class,
            TrackSeeder::class
        ]);
    }
}
