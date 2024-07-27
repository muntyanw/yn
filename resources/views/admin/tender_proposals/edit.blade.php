@extends('layouts.admin_layout')

@section('title', __('Edit Tender Proposal'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Edit Tender Proposal') }}</h2>
        <a href="{{ route('admin_tender_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    </div>

    <form action="{{ route('admin_tender_proposals_update', $proposal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="company_name">{{ __('Company Name') }}</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $proposal->company_name) }}" required>
        </div>

        <div class="form-group">
            <label for="legal_address">{{ __('Legal Address') }}</label>
            <input type="text" class="form-control" id="legal_address" name="legal_address" value="{{ old('legal_address', $proposal->legal_address) }}" required>
        </div>

        <div class="form-group">
            <label for="contact_person_name">{{ __('Contact Person Name') }}</label>
            <input type="text" class="form-control" id="contact_person_name" name="contact_person_name" value="{{ old('contact_person_name', $proposal->contact_person_name) }}" required>
        </div>

        <div class="form-group">
            <label for="contact_person_phone">{{ __('Contact Person Phone') }}</label>
            <input type="text" class="form-control" id="contact_person_phone" name="contact_person_phone" value="{{ old('contact_person_phone', $proposal->contact_person_phone) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>
@endsection
