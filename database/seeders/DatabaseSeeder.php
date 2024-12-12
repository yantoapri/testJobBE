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

        $this->call(ModulsSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleModulSeeder::class);
        $this->call(UserSeeder::class);
    }
}
