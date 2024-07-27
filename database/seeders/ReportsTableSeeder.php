<?php
// database/seeders/ReportsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Report;
use App\Models\ReportPhoto;

class ReportsTableSeeder extends Seeder
{
    public function run()
    {
        // Отключение проверки внешних ключей
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Очистка таблиц
        DB::table('report_photos')->truncate();
        DB::table('reports')->truncate();

        // Включение проверки внешних ключей
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Создание отчётов
        $reports = Report::factory()->count(5)->create();

        // Добавление фотографий к отчётам
        foreach ($reports as $report) {
            $photos = ReportPhoto::factory()->count(3)->make();
            foreach ($photos as $photo) {
                $report->photos()->save($photo);
            }
        }
    }
}
