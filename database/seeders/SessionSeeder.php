<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SessionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (DB::table('days')->pluck('id') as $dayId) {
            DB::table('sessions')->insert([
                'day_id' => $dayId,
                'type' => 'daily',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($dayId === DB::table('days')->orderBy('date')->first()->id) {
                DB::table('sessions')->insert([
                    'day_id' => $dayId,
                    'type' => 'weekly',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('sessions')->insert([
                    'day_id' => $dayId,
                    'type' => 'monthly',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
