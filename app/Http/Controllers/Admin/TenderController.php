<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tender;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    public function index()
    {
        $tenders = Tender::paginate(10);
        return view('admin.tenders.index', compact('tenders'));
    }

    public function create()
    {
        return view('admin.tenders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'publication_date' => 'nullable|date',
            'submission_deadline' => 'nullable|date',
            'delivery_date_range_start' => 'nullable|date',
            'delivery_date_range_end' => 'nullable|date',
            'product_service_name' => 'required|string|max:191',
            'quantity' => 'required|integer',
            'delivery_address' => 'required|string|max:191',
        ]);

        Tender::create($request->all());
        return redirect()->route('admin_tender_index')->with('success', __('Tender created successfully.'));
    }

    public function show($id)
    {
        $tender = Tender::findOrFail($id);
        return view('admin.tenders.show', compact('tender'));
    }

    public function edit($id)
    {
        $tender = Tender::findOrFail($id);
        return view('admin.tenders.edit', compact('tender'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'publication_date' => 'nullable|date',
            'submission_deadline' => 'nullable|date',
            'delivery_date_range_start' => 'nullable|date',
            'delivery_date_range_end' => 'nullable|date',
            'product_service_name' => 'required|string|max:191',
            'quantity' => 'required|integer',
            'delivery_address' => 'required|string|max:191',
        ]);

        $tender = Tender::findOrFail($id);
        $tender->update($request->all());
        return redirect()->route('admin_tender_index')->with('success', __('Tender updated successfully.'));
    }

    public function destroy($id)
    {
        $tender = Tender::findOrFail($id);
        $tender->delete();
        return redirect()->route('admin_tender_index')->with('success', __('Tender deleted successfully.'));
    }
}
