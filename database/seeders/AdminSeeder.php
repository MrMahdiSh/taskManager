<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::findOrCreate("admin");

        $createdUser = User::create(["name" => "admin", "email" => "admin@gmail.com", "password" => Hash::make("12345678910")]);

        $createdUser->assignRole($adminRole);
    }
}
