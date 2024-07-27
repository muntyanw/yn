<!-- resources/views/admin/tenders/index.blade.php -->
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
                    <th>{{ __('Product/Service Name') }}</th>
                    <th>{{ __('Quantity') }}</th>
                    <th>{{ __('Delivery Address') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tenders as $tender)
                    <tr>
                        <td>{{ $tender->publication_date ? $tender->publication_date->format('Y-m-d') : '-' }}</td>
                        <td>{{ $tender->submission_deadline ? $tender->submission_deadline->format('Y-m-d') : '-' }}</td>
                        <td>{{ $tender->product_service_name }}</td>
                        <td>{{ $tender->quantity }}</td>
                        <td>{{ $tender->delivery_address }}</td>
                        <td>
                            <a href="{{ route('admin_tender_show', ['id' => $tender->id]) }}"
                                class="btn btn-info btn-sm">{{ __('View') }}</a>
                            <a href="{{ route('admin_tender_edit', ['id' => $tender->id]) }}"
                                class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                            <form action="{{ route('admin_tender_destroy', ['id' => $tender->id]) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('{{ __('Are you sure you want to delete this tender?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">{{ __('No tenders found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $tenders->links() }}
        </div>
    </div>
@endsection
