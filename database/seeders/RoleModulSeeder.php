<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoleModuls;

class RoleModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleModuls::create([
            'role_id'   => 1,
            'moduls_id'  => 1,
            'access'    => "yes",
            'create'    => "yes",
            'update'    => "yes",
            'delete'    => "yes",
        ]);
        RoleModuls::create([
            'role_id'   => 2,
            'moduls_id'  => 1,
            'access'    => "yes",
            'create'    => "yes",
            'update'    => "yes",
            'delete'    => "yes",
        ]);
        RoleModuls::create([
            'role_id'   => 3,
            'moduls_id'  => 1,
            'access'    => "yes",
            'create'    => "no",
            'update'    => "no",
            'delete'    => "no",
        ]);
    }
}
