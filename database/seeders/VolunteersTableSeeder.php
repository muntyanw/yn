<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class VolunteersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('volunteers')->insert([
            [
                'user_id' => 1,
                'first_name' => 'Олександр',
                'middle_name' => 'Іванович',
                'last_name' => 'Петренко',
                'photo' => 'photos/alexander_petrenko.jpg',
                'registration_date' => Carbon::now(),
                'phone' => '+380123456789',
                'email' => 'alexander.petrenko@example.com',
                'address' => 'Київ, вул. Шевченка, 10',
            ],
            [
                'user_id' => 2,
                'first_name' => 'Марія',
                'middle_name' => 'Володимирівна',
                'last_name' => 'Іванова',
                'photo' => 'photos/maria_ivanova.jpg',
                'registration_date' => Carbon::now(),
                'phone' => '+380987654321',
                'email' => 'maria.ivanova@example.com',
                'address' => 'Львів, пр. Свободи, 5',
            ],
            [
                'user_id' => 3,
                'first_name' => 'Іван',
                'middle_name' => 'Петрович',
                'last_name' => 'Сидоренко',
                'photo' => 'photos/ivan_sydorenko.jpg',
                'registration_date' => Carbon::now(),
                'phone' => '+380123456123',
                'email' => 'ivan.sydorenko@example.com',
                'address' => 'Одеса, вул. Дерибасівська, 2',
            ],
        ]);
    }
}

