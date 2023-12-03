<?php

namespace Database\Seeders;

use App\Models\Roles;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class rolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::create(['name' => 'admin']);
        Roles::create(['name' => 'user']);
        Roles::create(['name' => 'writer']);

    }
}
