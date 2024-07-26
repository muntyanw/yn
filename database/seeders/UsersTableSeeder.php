<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user1 = User::create(
            [
                'name' => 'userRoot',
                'email' => 'pounitednation@gmail.com',
                'email_verified_at' => '2024-07-25 12:34:56',
                'password' => Hash::make('88888888'),
                'remember_token' => '',

            ]
        );
        $user2 = User::create(
            [
                'name' => 'userAdmin',
                'email' => 'mvv.prog@gmail.com',
                'email_verified_at' => '2024-07-25 12:34:56',
                'password' => Hash::make('88888888'),
                'remember_token' => '',
            ]
        );
        $user3 = User::create(
            [
                'name' => 'userVolunteer',
                'email' => 'muntyanw@gmail.com',
                'email_verified_at' => '2024-07-25 12:34:56',
                'password' => Hash::make('88888888'),
                'remember_token' => '',
            ]
        );

        Role::create([
            'name' => 'root',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'volonteer',
            'guard_name' => 'web',
        ]);
        Role::create([
            'name' => 'user',
            'guard_name' => 'web'
        ]);

        $user1->assignRole('root');
        $user2->assignRole('admin');
        $user3->assignRole('user');
    }
}
