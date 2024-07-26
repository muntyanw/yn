<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillVolunteerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skill_volunteer')->insert([
            ['volunteer_id' => 1, 'skill_id' => 1], // Adjust IDs based on your data
            ['volunteer_id' => 1, 'skill_id' => 2],
            ['volunteer_id' => 2, 'skill_id' => 3],
            ['volunteer_id' => 2, 'skill_id' => 4],
            ['volunteer_id' => 3, 'skill_id' => 5],
            ['volunteer_id' => 3, 'skill_id' => 6],
        ]);
    }
}

