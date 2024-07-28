@extends('layouts.admin_layout')

@section('title', __('Tenders proposals'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ __('Tenders proposals') }}</h2>
            <a href="{{ route('admin_tender_index') }}" class="btn btn-primary">{{ __('Add New Tender Proposal') }}</a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ __('Tender Title') }}</th>
                    <th>{{ __('Company Name') }}</th>
                    <th>{{ __('Legal Address') }}</th>
                    <th>{{ __('Contact Person Name') }}</th>
                    <th>{{ __('Contact Person Phone') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tenderProposals as $proposal)
                    <tr>
                        <td>{{ $proposal->tender->product_service_name ?? __('N/A') }}</td>
                        <td>{{ $proposal->company_name }}</td>
                        <td>{{ $proposal->legal_address }}</td>
                        <td>{{ $proposal->contact_person_name }}</td>
                        <td>{{ $proposal->contact_person_phone }}</td>
                        <td>
                            <a href="{{ route('admin_tender_proposals_show', ['id' => $proposal->id]) }}"
                               class="btn btn-info btn-sm">{{ __('View') }}</a>
                            <a href="{{ route('admin_tender_proposals_edit', ['id' => $proposal->id]) }}"
                               class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                            <form action="{{ route('admin_tender_proposals_destroy', ['id' => $proposal->id]) }}" method="POST"
                                  style="display:inline-block;" onsubmit="return confirm('{{ __('Are you sure you want to delete this tender proposal?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">{{ __('No tender proposals found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $tenderProposals->links() }}
        </div>
    </div>
@endsection
