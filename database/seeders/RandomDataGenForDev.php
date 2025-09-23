<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RandomDataGenForDev extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        /*// --- Rooms ---
        foreach (range(1, 10) as $index) {
            DB::table('rooms')->insert([
                'house' => $faker->company,     // Hausname
                'room' => $faker->word,         // Raumname
                'admin' => $faker->numberBetween(1, 10), // existierende user IDs
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // --- Plants ---
        foreach (range(1, 20) as $index) {
            DB::table('plants')->insert([
                'room_id' => $faker->numberBetween(1, 40),  // IDs aus rooms
                'name' => $faker->word,                    // Pflanzenname
                'watering_threshold' => $faker->randomFloat(2, 0.1, 1.0),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }*/

        // --- Measurements ---
        foreach (range(1, 180) as $index) {
            DB::table('measurements')->insert([
                'plant_id' => $faker->numberBetween(1, 80), // IDs aus plants
                'humidity' => $faker->randomFloat(2, 30, 90),
                'temperature' => $faker->randomFloat(2, 10, 35),
                'light' => $faker->randomFloat(2, 100, 2000),
                'water' => $faker->randomFloat(2, 0, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
