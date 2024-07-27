<!-- resources/views/admin/tenders/create.blade.php -->
@extends('layouts.admin_layout')

@section('title', __('Create Tender'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('Create Tender') }}</h2>
            <a href="{{ route('admin_tender_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <form action="{{ route('admin_tender_store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="publication_date">{{ __('Publication Date') }}</label>
                <input type="date" class="form-control" id="publication_date" name="publication_date">
                @error('publication_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="submission_deadline">{{ __('Submission Deadline') }}</label>
                <input type="date" class="form-control" id="submission_deadline" name="submission_deadline">
                @error('submission_deadline')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="delivery_date_range_start">{{ __('Delivery Date Range Start') }}</label>
                <input type="date" class="form-control" id="delivery_date_range_start" name="delivery_date_range_start">
                @error('delivery_date_range_start')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="delivery_date_range_end">{{ __('Delivery Date Range End') }}</label>
                <input type="date" class="form-control" id="delivery_date_range_end" name="delivery_date_range_end">
                @error('delivery_date_range_end')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="product_service_name">{{ __('Product/Service Name') }}</label>
                <input type="text" class="form-control" id="product_service_name" name="product_service_name" required>
                @error('product_service_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="quantity">{{ __('Quantity') }}</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="delivery_address">{{ __('Delivery Address') }}</label>
                <input type="text" class="form-control" id="delivery_address" name="delivery_address" required>
                @error('delivery_address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>
@endsection
