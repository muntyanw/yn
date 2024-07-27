@extends('layouts.admin_layout')

@section('title', __('Create Tender Proposal'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Create Tender Proposal') }}</h2>
        <a href="{{ route('admin_tender_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    </div>

    <!-- Информация о тендере -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>{{ __('Tender Information') }}</h3>
        </div>
        <div class="card-body">
            <p><strong>{{ __('Publication Date') }}:</strong> {{ $tender->publication_date }}</p>
            <p><strong>{{ __('Submission Deadline') }}:</strong> {{ $tender->submission_deadline }}</p>
            <p><strong>{{ __('Delivery Date Range Start') }}:</strong> {{ $tender->delivery_date_range_start }}</p>
            <p><strong>{{ __('Delivery Date Range End') }}:</strong> {{ $tender->delivery_date_range_end }}</p>
            <p><strong>{{ __('Product/Service Name') }}:</strong> {{ $tender->product_service_name }}</p>
            <p><strong>{{ __('Quantity') }}:</strong> {{ $tender->quantity }}</p>
            <p><strong>{{ __('Delivery Address') }}:</strong> {{ $tender->delivery_address }}</p>
        </div>
    </div>

    <form action="{{ route('admin_tender_proposals_store') }}" method="POST">
        @csrf
        <input type="hidden" name="tender_id" value="{{ $tender->id }}">

        <div class="form-group">
            <label for="company_name">{{ __('Company Name') }}</label>
            <input type="text" class="form-control" id="company_name" name="company_name" required>
        </div>

        <div class="form-group">
            <label for="legal_address">{{ __('Legal Address') }}</label>
            <input type="text" class="form-control" id="legal_address" name="legal_address" required>
        </div>

        <div class="form-group">
            <label for="contact_person_name">{{ __('Contact Person Name') }}</label>
            <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" required>
        </div>

        <div class="form-group">
            <label for="contact_person_phone">{{ __('Contact Person Phone') }}</label>
            <input type="text" class="form-control" id="contact_person_phone" name="contact_person_phone" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>
@endsection
