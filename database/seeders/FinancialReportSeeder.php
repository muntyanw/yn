<?php

use Illuminate\Database\Seeder;
use App\Models\FinancialReport;
use App\Models\FinancialReportFile;

class FinancialReportSeeder extends Seeder
{
    public function run()
    {
        $report1 = FinancialReport::create([
            'year' => 2023,
            'comment' => 'Фінансовий звіт за 2023 рік.',
        ]);

        $report2 = FinancialReport::create([
            'year' => 2022,
            'comment' => 'Фінансовий звіт за 2022 рік.',
        ]);

        // Добавление файлов к первому отчету
        FinancialReportFile::create([
            'financial_report_id' => $report1->id,
            'file_path' => 'financial_reports/2023_report.pdf',
        ]);

        FinancialReportFile::create([
            'financial_report_id' => $report1->id,
            'file_path' => 'financial_reports/2023_statement.xlsx',
        ]);

        // Добавление файлов ко второму отчету
        FinancialReportFile::create([
            'financial_report_id' => $report2->id,
            'file_path' => 'financial_reports/2022_report.pdf',
        ]);
    }
}

