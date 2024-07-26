<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offers')->insert([
            [
                'title' => 'Юридична консультація',
                'image' => 'juridical_consultation.jpg',
                'description' => 'Відповідальні юристи пропонують консультації по всім юридичним питанням.',
                'skills_type' => 'Юрист',
                'created_at' => Carbon::now(),
                'vacancies' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Психологічна допомога',
                'image' => 'psychological_help.jpg',
                'description' => 'Психологи надають допомогу у кризових ситуаціях і особистих питаннях.',
                'skills_type' => 'Психолог',
                'created_at' => Carbon::now(),
                'vacancies' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Журналістські розслідування',
                'image' => 'journalistic_investigations.jpg',
                'description' => 'Журналісти проводять розслідування та публікують актуальні матеріали.',
                'skills_type' => 'Журналіст',
                'created_at' => Carbon::now(),
                'vacancies' => 5,
                'is_active' => true,
            ],
            // Добавьте другие записи по необходимости
        ]);
    }
}

