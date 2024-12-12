<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::create([
            'name' => 'superadmin',
        ]);
        Roles::create([
            'name' => 'manajer',
        ]);
        Roles::create([
            'name' => 'employee',
        ]);
    }
}
