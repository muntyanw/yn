<!-- resources/views/admin/tenders/show.blade.php -->
@extends('layouts.admin_layout')

@section('title', __('View Tender'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('View Tender') }}</h2>
            <a href="{{ route('admin_tender_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <div class="card">
            <div class="card-body">
                <p><strong>{{ __('Publication Date') }}:</strong> {{ $tender->publication_date ? $tender->publication_date->format('Y-m-d') : '-' }}</p>
                <p><strong>{{ __('Submission Deadline') }}:</strong> {{ $tender->submission_deadline ? $tender->submission_deadline->format('Y-m-d') : '-' }}</p>
                <p><strong>{{ __('Delivery Date Range Start') }}:</strong> {{ $tender->delivery_date_range_start ? $tender->delivery_date_range_start->format('Y-m-d') : '-' }}</p>
                <p><strong>{{ __('Delivery Date Range End') }}:</strong> {{ $tender->delivery_date_range_end ? $tender->delivery_date_range_end->format('Y-m-d') : '-' }}</p>
                <p><strong>{{ __('Product/Service Name') }}:</strong> {{ $tender->product_service_name }}</p>
                <p><strong>{{ __('Quantity') }}:</strong> {{ $tender->quantity }}</p>
                <p><strong>{{ __('Delivery Address') }}:</strong> {{ $tender->delivery_address }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin_tender_edit', ['id' => $tender->id]) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                <form action="{{ route('admin_tender_destroy', ['id' => $tender->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('Are you sure you want to delete this tender?') }}');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
