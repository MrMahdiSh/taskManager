<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DaySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(-3, 3) as $offset) {
            $day = DB::table('days')->insertGetId([
                'date' => now()->addDays($offset)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach (range(1, rand(2, 4)) as $taskIndex) {
                DB::table('tasks')->insert([
                    'day_id' => $day,
                    'title' => $faker->sentence,
                    'description' => $faker->paragraph,
                    'status' => $faker->boolean, // Changed to boolean values
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('sessions')->insert([
                'day_id' => $day,
                'type' => 1, // Changed to integer values for type
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($offset === 0) {
                DB::table('sessions')->insert([
                    'day_id' => $day,
                    'type' => 2, // Changed to integer values for type
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('sessions')->insert([
                    'day_id' => $day,
                    'type' => 3, // Changed to integer values for type
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        foreach (range(1, rand(1, 2)) as $routineIndex) {
            DB::table('routines')->insert([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
