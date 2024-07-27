<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $thiclears->call([
            UsersTableSeeder::class,
            SkillsTableSeeder::class,
            VolunteersTableSeeder::class,
            SkillVolunteerTableSeeder::class,
            OffersTableSeeder::class,
            ReportsTableSeeder::class,
            TenderProposalsTableSeeder::class,
            TendersTableSeeder::class,

        ]);
    }
}