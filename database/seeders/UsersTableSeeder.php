<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'userRoot',
                'email' => 'pounitednation@gmail.com',
                'email_verified_at' => '2024-07-25 12:34:56',
                'password' => '88888888',
                'remember_token' => '',
            
            ],
            [
                'name' => 'userAdmin',
                'email' => 'mvv.prog@gmail.com',
                'email_verified_at' => '2024-07-25 12:34:56',
                'password' => '88888888',
                'remember_token' => '',
            
            ],
            [
                'name' => 'userVolunteer',
                'email' => 'muntyanw@gmail.com',
                'email_verified_at' => '2024-07-25 12:34:56',
                'password' => '88888888',
                'remember_token' => '',
            
            ],
        ]);
    }
}
