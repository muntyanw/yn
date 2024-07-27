<?php

// app/Http/Controllers/Admin/ReportController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\ReportPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
   public function index()
   {
      $reports = Report::paginate(20);
      return view('admin.report.listReport', compact('reports'));
   }

   public function create()
   {
      return view('admin.report.createReport');
   }

   public function store(Request $request)
   {
      // Validate the incoming request data
      $request->validate([
         'month' => 'required|integer',
         'year' => 'required|integer',
         'text' => 'required|string',
         'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for multiple photo files
      ]);

      // Create a new report
      $report = Report::create([
         'month' => $request->month,
         'year' => $request->year,
         'text' => $request->text,
      ]);

      // Process and save the photos
      if ($request->hasFile('photos')) {
         foreach ($request->file('photos') as $photo) {
            // Store the photo and get its path
            $path = $photo->store('reports', 'public');

            // Create an HTML linkFfor the photo
            $htmlLink = '<img src="' . asset('storage/' . $path) . '" alt="Report Photo">';

            // Save the photo details in the report_photos table
            ReportPhoto::create([
               'report_id' => $report->id,
               'photo' => $path,
               'html_link' => $htmlLink,
            ]);
         }
      }

      // Redirect or return response
      return redirect()->route('reports.index')->with('success', __('Report created successfully.'));
   }

   public function edit($id)
   {
      $report = Report::with('photos')->findOrFail($id);
      return view('admin.report.editReport', compact('report'));
   }

   public function update(Request $request, $id)
   {
      $request->validate([
         'month' => 'required|integer',
         'year' => 'required|integer',
         'text' => 'required',
         'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
      ]);

      $report = Report::findOrFail($id);
      $report->update($request->all());

      if ($request->hasFile('photos')) {
         foreach ($request->file('photos') as $photo) {
            $path = $photo->store('reports', 'public');
            $htmlLink = '<img src="' . asset('storage/' . $path) . '" alt="Report Photo">';
            ReportPhoto::create(['report_id' => $report->id, 'photo' => $path, 'html_link' => $htmlLink]);
         }
      }

      return redirect()->route('admin_reports_list')->with('success', __('Report updated successfully.'));
   }

   public function destroy($id)
   {
      $report = Report::findOrFail($id);
      $report->delete();
      return redirect()->route('admin_reports_list')->with('success', __('Report deleted successfully.'));
   }

   public function show($id)
   {
      $report = Report::with('photos')->findOrFail($id);
      return view('admin.report.showReport', compact('report'));
   }
}
