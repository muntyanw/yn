@extends('layouts.admin_layout')

@section('title', __('Tender Proposal Details'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('Tender Proposal Details') }}</h2>
            <a href="{{ route('admin_tender_proposals_list') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <dl class="row">
            <dt class="col-sm-3">{{ __('Company Name') }}</dt>
            <dd class="col-sm-9">{{ $tenderProposal->company_name }}</dd>

            <dt class="col-sm-3">{{ __('Legal Address') }}</dt>
            <dd class="col-sm-9">{{ $tenderProposal->legal_address }}</dd>

            <dt class="col-sm-3">{{ __('Contact Person Name') }}</dt>
            <dd class="col-sm-9">{{ $tenderProposal->contact_person_name }}</dd>

            <dt class="col-sm-3">{{ __('Contact Person Phone') }}</dt>
            <dd class="col-sm-9">{{ $tenderProposal->contact_person_phone }}</dd>
        </dl>

        <a href="{{ route('admin_tender_proposals_edit', ['tenderProposal' => $tenderProposal->id]) }}" class="btn btn-warning">{{ __('Edit') }}</a>
        <form action="{{ route('admin_tender_proposals_destroy', ['tenderProposal' => $tenderProposal->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('Are you sure you want to delete this tender proposal?') }}');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
        </form>
    </div>
@endsection
