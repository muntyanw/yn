@extends('layouts.admin_layout')

@section('title', __('Tenders'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{ __('Tenders') }}</h2>
        <a href="{{ route('admin_tender_create') }}" class="btn btn-primary">{{ __('Add New Tender') }}</a>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>{{ __('Publication Date') }}</th>
                <th>{{ __('Submission Deadline') }}</th>
                <th>{{ __('Delivery Date Range Start') }}</th>
                <th>{{ __('Delivery Date Range End') }}</th>
                <th>{{ __('Product/Service Name') }}</th>
                <th>{{ __('Quantity') }}</th>
                <th>{{ __('Delivery Address') }}</th>
                <th>{{ __('Actions') }}</th>
                <th>{{ __('Tender Proposals') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tenders as $tender)
                <tr>
                    <td>{{ $tender->publication_date }}</td>
                    <td>{{ $tender->submission_deadline }}</td>
                    <td>{{ $tender->delivery_date_range_start }}</td>
                    <td>{{ $tender->delivery_date_range_end }}</td>
                    <td>{{ $tender->product_service_name }}</td>
                    <td>{{ $tender->quantity }}</td>
                    <td>{{ $tender->delivery_address }}</td>
                    <td>
                        <a href="{{ route('admin_tender_edit', $tender->id) }}" class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                        <form action="{{ route('admin_tender_destroy', $tender->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('Are you sure you want to delete this tender?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('admin_tender_proposals_create', ['tenderId' => $tender->id]) }}" class="btn btn-primary btn-sm">{{ __('Add Proposal') }}</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">{{ __('No tenders found') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Пагинация -->
    <div class="d-flex justify-content-center mt-4">
        {{ $tenders->links() }}
    </div>
</div>
@endsection
