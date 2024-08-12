<?php

// app/Http/Controllers/Admin/ReportController.php
namespace App\Http\Controllers\Admin;

use App\Models\Report;
use App\Models\ReportPhoto;
use Illuminate\Http\Request;
use App\Models\ReportFile;
use Illuminate\Support\Facades\Storage;

class ReportController extends AdminBaseController
{
   public function index(Request $request)
   {
      $query = Report::query();

      // Поиск по всем полям
      if ($request->has('search') && strlen($request->get('search')) > 3) {
         $search = $request->get('search');
         $query->where(function ($q) use ($search) {
            $q->where('month', 'like', '%' . $search . '%')
               ->orWhere('year', 'like', '%' . $search . '%')
               ->orWhereHas('photos', function ($q) use ($search) {
                  $q->where('photo', 'like', '%' . $search . '%');
               })
               ->orWhereHas('files', function ($q) use ($search) {
                  $q->where('file_path', 'like', '%' . $search . '%');
               })
               ->orWhere('text', 'like', '%' . $search . '%');
         });
      }

      // Поиск по месяцу
      if ($request->has('month_search') && strlen($request->get('month_search')) > 0) {
         $monthSearch = $request->get('month_search');
         $query->where('month', 'like', '%' . $monthSearch . '%');
      }

      // Поиск по году
      if ($request->has('year_search') && strlen($request->get('year_search')) > 0) {
         $yearSearch = $request->get('year_search');
         $query->where('year', 'like', '%' . $yearSearch . '%');
      }

      // Сортировка
      $sortColumn = $request->get('sort', 'month'); // выбранный столбец, по умолчанию 'month'
      $sortDirection = $request->get('direction', 'asc'); // направление сортировки, по умолчанию 'asc'

      $query->orderBy($sortColumn, $sortDirection);

      if ($sortColumn !== 'year') {
         $query->orderBy('year', 'asc'); // вторичная сортировка по году, если год не выбран для первичной сортировки
      }
      if ($sortColumn !== 'month') {
         $query->orderBy('month', 'asc'); // третичная сортировка по месяцу, если месяц не выбран для первичной сортировки
      }
      $query->orderBy('id', 'asc'); // дополнительная сортировка по ID

      $reports = $query->paginate(20);

      if ($request->ajax()) {
         return view('admin.report.partials.table', compact('reports'))->render();
      }

      return view('admin.report.index', compact('reports'));
   }

   public function create()
   {
      // Передаем пустую модель в представление, чтобы использовать ту же форму для создания
      $report = new Report();

      return view('admin.report.editReport', compact('report'));
   }

   public function edit($id)
   {
      $report = Report::with('photos')->with('files')->findOrFail($id);
      return view('admin.report.editReport', compact('report'));
   }

   public function update(Request $request, $id = null)
   {
      // Предварительная обработка данных
      $input = $request->all();
      $input['month'] = (int)$request->input('month');
      $input['year'] = (int)$request->input('year');
      $request->replace($input);

      $request->validate([
         'month' => 'required|integer',
         'year' => 'required|integer',
         'combined_content' => 'required|string',
         // 'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
      ]);

      if (!empty($id)) {
         $report = Report::findOrFail($id);
      } else {
         // Create a new report
         $report = Report::create([
            'month' => $request->month,
            'year' => $request->year,
            'text' => $request->combined_content,
         ]);
      }

      $report->month = $request->month;
      $report->year = $request->year;
      $report->text = $request->combined_content;

      if ($request->hasFile('photos')) {
         foreach ($request->file('photos') as $photo) {
            $originalName = $photo->getClientOriginalName();
            $path = $photo->storeAs('reports', $originalName, 'public');
            $htmlLink = '<img src="' . asset('storage/' . $path) . '" alt="Report Photo">';
            ReportPhoto::create(['report_id' => $report->id, 'photo' => $path, 'html_link' => $htmlLink]);
         }
      }

      if ($request->hasFile('files')) {
         foreach ($request->file('files') as $file) {
            $originalName = $file->getClientOriginalName();
            $path = $file->storeAs('report_files', $originalName, 'public');
            ReportFile::create([
               'report_id' => $report->id,
               'file_path' => $path
            ]);
         }
      }

      if ($request->file_urls) {
         $fileUrls = explode("\n", str_replace("\r", "", $request->file_urls));
         foreach ($fileUrls as $file_url) {
            if (!empty($file_url)) {
               ReportFile::create([
                  'report_id' => $report->id,
                  'file_url' => trim($file_url)
               ]);
            }
         }
      }

      $report->save();

      return "ok";
      // return redirect()->route('admin_report_list')->with('success', __('Report updated successfully.'));
   }

   public function destroy($id)
   {
      $report = Report::findOrFail($id);
      $report->delete();
      return redirect()->route('admin_report_list')->with('success', __('Report deleted successfully.'));
   }

   public function show($id)
   {
      $report = Report::with('photos')->findOrFail($id);
      return view('admin.report.showReport', compact('report'));
   }

   public function deletePhoto($reportId, $photoId)
   {
      $report = Report::findOrFail($reportId);
      $photo = $report->photos()->findOrFail($photoId);

      // Удаление файла из хранилища
      Storage::delete($photo->photo);

      // Удаление записи из базы данных
      $photo->delete();

      return response()->json(['success' => 'Photo deleted successfully.']);
   }

   public function removeFile($reportId, $fileId)
   {
      $report = Report::findOrFail($reportId);
      $file = $report->files()->findOrFail($fileId);

      if (Storage::exists($file)) {
         // Удалите файл из хранилища
         Storage::delete($file->file);
      }

      // Удалите запись из базы данных
      $file->delete();

      return response()->json(['success' => __('File deleted successfully')]);
   }

   public function uploadPhoto(Request $request)
   {
      $request->validate([
         'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      if ($request->hasFile('photo')) {
         $originalName = $request->file('photo')->getClientOriginalName();
         $path = $request->file('photo')->storeAs('photos', $originalName, 'public');
         $url = Storage::url($path);

         return response()->json(['success' => true, 'url' => $url]);
      }

      return response()->json(['success' => false, 'message' => 'Failed to upload photo']);
   }
}
