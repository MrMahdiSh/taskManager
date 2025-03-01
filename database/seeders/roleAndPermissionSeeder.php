<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(["name" => "admin", "guard_name" => "api"]);

        Permission::create(["name" => "create user", "guard_name" => "api"]);
        Permission::create(["name" => "read user", "guard_name" => "api"]);
        Permission::create(["name" => "update user", "guard_name" => "api"]);
        Permission::create(["name" => "delete user", "guard_name" => "api"]);

        $adminRole->givePermissionTo(["create user", "read user", "update user", "delete user"]);
    }
}
