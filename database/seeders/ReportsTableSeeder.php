<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->insert([
            [
                'month' => 7, // Липень
                'year' => 2024,
                'text' => 'Звіт за липень 2024 року. Основні досягнення: ...',
            ],
            [
                'month' => 6, // Червень
                'year' => 2024,
                'text' => 'Звіт за червень 2024 року. Основні досягнення: ...',
            ],
        ]);
    }
}

