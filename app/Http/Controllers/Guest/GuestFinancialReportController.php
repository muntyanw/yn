<?php

namespace App\Http\Controllers\Guest;

use App\Models\FinancialReport;
use App\Models\FinancialReportFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class GuestFinancialReportController extends Controller
{
    public function show($year)
    {
        $financialReport = FinancialReport::where('year', $year)->with('files')->firstOrFail();
        $availableYears = FinancialReport::select('year')->distinct()->orderBy('year', 'desc')->get();

        return view('guest.financial_reports.show', compact('financialReport', 'availableYears'));
    }

    public function last()
    {
        // Получаем доступные года для финансовых отчетов
        $availableYears = FinancialReport::select('year')->distinct()->orderBy('year', 'desc')->get();

        // Проверяем, есть ли доступные отчеты
        if ($availableYears->isEmpty()) {
            // Если нет отчетов, возвращаем представление с сообщением
            return view('guest.financial_reports.show', [
                'financialReport' => null,
                'availableYears' => $availableYears
            ]);
        }

        // Получаем последний доступный отчет
        $financialReport = FinancialReport::orderBy('year', 'desc')->with('files')->first();

        return view('guest.financial_reports.show', compact('financialReport', 'availableYears'));
    }
}
