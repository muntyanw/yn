<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            ['name' => 'Юрист', 'description' => 'Фахівець з правознавства'],
            ['name' => 'Психолог', 'description' => 'Фахівець з психології'],
            ['name' => 'Журналіст', 'description' => 'Фахівець з журналістики'],
            ['name' => 'Вихователь', 'description' => 'Фахівець з виховання дітей'],
            ['name' => 'Педагог', 'description' => 'Фахівець з освіти'],
            ['name' => 'Тренер', 'description' => 'Фахівець з фізичної підготовки та навчання'],
        ]);
    }
}

