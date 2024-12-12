<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'superadmin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('p4ssw0rd'),
            'role_id'   => 1
        ]);
        User::factory()->create([
            'name' => 'manajer',
            'email' => 'manajer@gmail.com',
            'password' => bcrypt('p4ssw0rd'),
            'role_id'   => 2
        ]);
        User::factory()->create([
            'name' => 'employee',
            'email' => 'employee@gmail.com',
            'password' => bcrypt('p4ssw0rd'),
            'role_id'   => 3
        ]);
    }
}
