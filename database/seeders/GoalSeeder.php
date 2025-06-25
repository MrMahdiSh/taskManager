<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GoalSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, rand(5, 10)) as $index) {
            DB::table('goals')->insert([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'status' => $faker->randomElement(['planned', 'active', 'done']),
                'deadline' => $faker->dateTimeBetween('now', '+1 year'),
                'priority' => $faker->randomElement(['low', 'medium', 'high']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}