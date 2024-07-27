<!-- resources/views/admin/offers/show.blade.php -->
@extends('layouts.admin_layout')

@section('title', __('View Offer'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('View Offer') }}</h2>
            <a href="{{ route('admin_offers_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <div class="form-group">
            <label>{{ __('Title') }}</label>
            <p>{{ $offer->title }}</p>
        </div>
        <div class="form-group">
            <label>{{ __('Image') }}</label>
            @if ($offer->image)
                <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ __('Image') }}" class="img-thumbnail"
                    width="150">
            @else
                <p>{{ __('No Image') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label>{{ __('Description') }}</label>
            <div>{!! $offer->description !!}</div>
        </div>
        <div class="form-group">
            <label>{{ __('Skills Type') }}</label>
            <p>{{ $offer->skills_type }}</p>
        </div>
        <div class="form-group">
            <label>{{ __('Vacancies') }}</label>
            <p>{{ $offer->vacancies }}</p>
        </div>
        <div class="form-group">
            <label>{{ __('Active') }}</label>
            <p>{{ $offer->is_active ? __('Yes') : __('No') }}</p>
        </div>

        <!-- Edit button -->
        <div class="mt-3">
            <a href="{{ route('admin_offer_edit', ['id' => $offer->id]) }}"
                class="btn btn-warning">{{ __('Edit') }}</a>
        </div>
    </div>
@endsection
