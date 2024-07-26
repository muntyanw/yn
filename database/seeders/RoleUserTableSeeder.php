<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
            ['user_id' => 1, 'role_id' => 1], // Assuming user with ID 1 is Admin
            ['user_id' => 2, 'role_id' => 2], // Assuming user with ID 2 is User
            ['user_id' => 3, 'role_id' => 3], // Assuming user with ID 3 is Editor
        ]);
    }
}