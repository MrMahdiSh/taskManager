<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(SampleWorkSeeder::class);
        $this->call(roleAndPermissionSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(GoalSeeder::class);
        $this->call(DaySeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(RoutineSeeder::class);
        $this->call(SessionSeeder::class);
    }
}
