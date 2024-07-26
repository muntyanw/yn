<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'root', 'description' => 'Super Administrator role'],
            ['name' => 'Admin', 'description' => 'Administrator role'],
            ['name' => 'User', 'description' => 'Regular user role'],
            ['name' => 'volunteer', 'description' => 'Volunteer role'],
        ]);
    }
}
