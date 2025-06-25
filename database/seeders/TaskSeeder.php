<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (DB::table('days')->pluck('id') as $dayId) {
            foreach (range(1, rand(2, 4)) as $index) {
                DB::table('tasks')->insert([
                    'day_id' => $dayId,
                    'title' => $faker->sentence,
                    'description' => $faker->paragraph,
                    'status' => $faker->boolean, // Changed to boolean values
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}