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
        // احرص على أن RolesTableSeeder ينشئ السجلات: organizer / audience
        $this->call([
            RolesTableSeeder::class,   // يجب أن يسبق UserSeeder
            UserSeeder::class,
            LocationSeeder::class,
            SpeakerSeeder::class,
            EventSeeder::class,
            RegistrationSeeder::class,
        ]);
    }
}
