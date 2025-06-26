<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoutineSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (DB::table('days')->pluck('id') as $dayId) {
            foreach (range(1, rand(1, 2)) as $index) {
                DB::table('routines')->insert([
                    'title' => $faker->sentence,
                    'description' => $faker->paragraph,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
