<?php

namespace App\Http\Controllers\Guest;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestReportController extends Controller
{
   public function index()
   {
      $years = Report::select('year')->distinct()->pluck('year')->sortDesc();
      $lastYear = $years->first();
      $reportsByYear = [];

      foreach ($years as $year) {
         $reportsByYear[$year] = Report::where('year', $year)->pluck('month');
      }

      return view('guest.reports.index', compact('years', 'reportsByYear', 'lastYear'));
   }

   public function showYear($year)
   {
      $reports = Report::where('year', $year)->get();
      return view('guest.reports.year', compact('year', 'reports'));
   }

   public function showMonth($year, $month)
   {
      $report = Report::where('year', $year)->where('month', $month)->firstOrFail();
      return view('guest.reports.month', compact('year', 'month', 'report'));
   }

   public function getMonths($year)
   {
      $months = Report::where('year', $year)->pluck('month')->toArray();
      return response()->json($months);
   }
}
