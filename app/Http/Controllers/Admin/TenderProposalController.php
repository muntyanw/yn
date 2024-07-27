<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TenderProposal;
use Illuminate\Http\Request;
use App\Models\Tender;

class TenderProposalController extends Controller
{
    public function index()
    {
        $tenderProposals = TenderProposal::paginate(20);
        return view('admin.tender_proposals.index', compact('tenderProposals'));
    }

    public function create($tenderId)
    {
        $tender = Tender::findOrFail($tenderId);
        return view('admin.tender_proposals.create', compact('tender'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:191',
            'legal_address' => 'required|string|max:191',
            'contact_person_name' => 'required|string|max:191',
            'contact_person_phone' => 'required|string|max:191',
            'tender_id' => 'required|exists:tenders,id',
        ]);

        TenderProposal::create($validated);

        return redirect()->route('admin_tender_proposals_list')->with('success', __('Tender Proposal created successfully.'));
    }

    public function edit(TenderProposal $tenderProposal)
    {
        return view('admin.tender_proposals.edit', compact('tenderProposal'));
    }

    public function update(Request $request, TenderProposal $tenderProposal)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'legal_address' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
            'contact_person_phone' => 'required|string|max:255',
        ]);

        $tenderProposal->update($request->all());

        return redirect()->route('admin_tender_proposals_list')
            ->with('success', __('Tender Proposal updated successfully.'));
    }

    public function destroy(TenderProposal $tenderProposal)
    {
        $tenderProposal->delete();

        return redirect()->route('admin_tender_proposals_list')
            ->with('success', __('Tender Proposal deleted successfully.'));
    }

    public function show(TenderProposal $tenderProposal)
    {
        return view('admin.tender_proposals.show', compact('tenderProposal'));
    }
}
