<?php

namespace App\Http\Controllers\Guest;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestReportController extends Controller
{

   public function last()
   {
      // Получаем последний доступный отчет
      $lastReport = Report::orderBy('year', 'desc')->orderBy('month', 'desc')->first();

      // Если отчетов нет, возвращаем пустые коллекции и null для выбранного года и месяца
      if (!$lastReport) {
         return view('guest.reports.show', [
            'years' => collect(),
            'reportsByYear' => collect(),
            'report' => null,
            'selectedYear' => null,
            'selectedMonth' => null,
         ]);
      }

      // Получаем доступные года, преобразовывая их в целые числа
      $years = Report::select('year')->distinct()->orderBy('year', 'desc')->get()->map(function ($year) {
         return (int) $year->year;
      });

      // Получаем доступные месяцы для последнего года в обратном порядке
      $reportsByYear = Report::where('year', $lastReport->year)
         ->orderBy('month', 'desc')
         ->pluck('month')
         ->map(function ($month) {
            return (int) $month;
         })
         ->toArray();

      // Возвращаем представление с данными
      return view('guest.reports.show', [
         'years' => $years,
         'reportsByYear' => $reportsByYear,
         'report' => $lastReport,
         'selectedYear' => (int) $lastReport->year,
         'selectedMonth' => (int) $lastReport->month,
      ]);
   }



   public function showYear($year)
   {
      // Получаем последний отчет за указанный год
      $lastReportOfYear = Report::where('year', (int) $year)->orderBy('month', 'desc')->first();

      // Если за указанный год отчетов нет, возвращаем представление с пустыми коллекциями
      if (!$lastReportOfYear) {
         return view('guest.reports.show', [
            'years' => Report::select('year')->distinct()->orderBy('year', 'desc')->get()->map(function ($year) {
               return (int) $year->year;
            }),
            'reportsByYear' => collect(),
            'report' => null,
            'selectedYear' => (int) $year,
            'selectedMonth' => null,
         ]);
      }

      // Получаем доступные года, преобразовывая их в целые числа
      $years = Report::select('year')->distinct()->orderBy('year', 'desc')->get()->map(function ($year) {
         return (int) $year->year;
      });

      // Получаем доступные месяцы для указанного года в обратном порядке
      $reportsByYear = Report::where('year', (int) $year)
         ->orderBy('month', 'desc')
         ->pluck('month')
         ->map(function ($month) {
            return (int) $month;
         })
         ->toArray();

      // Возвращаем представление с данными
      return view('guest.reports.show', [
         'years' => $years,
         'reportsByYear' => $reportsByYear,
         'report' => $lastReportOfYear,
         'selectedYear' => (int) $year,
         'selectedMonth' => (int) $lastReportOfYear->month,
      ]);
   }



   public function showMonth($year, $month)
   {
      // Приведение параметров $year и $month к целым числам
      $year = (int) $year;
      $month = (int) $month;

      // Получаем отчет за указанный год и месяц
      $report = Report::where('year', $year)->where('month', $month)->firstOrFail();

      // Получаем доступные года, преобразовывая их в целые числа
      $years = Report::select('year')->distinct()->orderBy('year', 'desc')->get()->map(function ($year) {
         return (int) $year->year;
      });

      // Получаем доступные месяцы для указанного года в обратном порядке
      $reportsByYear = Report::where('year', $year)
         ->orderBy('month', 'desc')
         ->pluck('month')
         ->map(function ($month) {
            return (int) $month;
         })
         ->toArray();

      // Возвращаем представление с данными
      return view('guest.reports.show', [
         'years' => $years,
         'reportsByYear' => $reportsByYear,
         'report' => $report,
         'selectedYear' => $year,
         'selectedMonth' => $month,
      ]);
   }
}
