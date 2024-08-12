<?php

namespace App\Http\Controllers\Admin;

use App\Models\FinancialReport;
use App\Models\FinancialReportFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class FinancialReportController extends Controller
{
    public function index()
    {
        $financialReports = FinancialReport::with('files')->paginate(20);

        return view('admin.financial_reports.index', compact('financialReports'));
    }

    public function create()
    {
        // Передаем пустую модель в представление, чтобы использовать ту же форму для создания
        $financialReport = new FinancialReport();

        return view('admin.financial_reports.edit', compact('financialReport'));
    }

    public function edit($id)
    {
        // Ищем финансовый отчет по идентификатору
        $financialReport = FinancialReport::with('files')->findOrFail($id);

        // Передаем данные отчета в представление для редактирования
        return view('admin.financial_reports.edit', compact('financialReport'));
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        try {
            $report = $id ? FinancialReport::findOrFail($id) : new FinancialReport();
            $report->year = $request->year;
            $report->comment = $request->comment;
            $report->save();

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $originalName = $file->getClientOriginalName();
                    $path = $file->storeAs('financial_reports', $originalName, 'public');
                    FinancialReportFile::create([
                        'financial_report_id' => $report->id,
                        'file_path' => $path
                    ]);
                }
            }

            return response()->json(['success' => true, 'message' => 'Financial report saved successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    public function show($year)
    {
        $report = FinancialReport::where('year', $year)->with('files')->firstOrFail();
        return response()->json($report);
    }

    public function destroy($id)
    {
        try {
            $report = FinancialReport::findOrFail($id);

            // Удаляем связанные файлы
            foreach ($report->files as $file) {
                Storage::delete($file->file_path);
                $file->delete();
            }

            // Удаляем сам отчет
            $report->delete();

            return response()->json(['success' => true, 'message' => 'Financial report deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function deleteFile(Request $request)
    {
        try {
            // Ищем запись о файле в базе данных
            $file = FinancialReportFile::findOrFail($request->id);

            // Пытаемся удалить физический файл, если он существует
            if (Storage::exists($file->file_path)) {
                Storage::delete($file->file_path);
            }

            // Удаляем запись из базы данных
            $file->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
