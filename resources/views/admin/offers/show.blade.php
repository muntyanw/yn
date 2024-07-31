<!-- resources/views/admin/offers/show.blade.php -->
@extends('layouts.admin_layout')

@section('title', __('View Offer'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">{{ __('View Offer') }}</h2>
            <a href="{{ route('admin_offers_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <div class="card shadow-sm p-4 mb-4">
            <div class="form-group">
                <label class="font-weight-bold">{{ __('Title') }}</label>
                <p>{{ $offer->title }}</p>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">{{ __('Image') }}</label>
                @if ($offer->image)
                    <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ __('Image') }}" class="img-thumbnail"
                        width="150">
                @else
                    <p>{{ __('No Image') }}</p>
                @endif
            </div>
            <div class="form-group">
                <label class="font-weight-bold">{{ __('Description') }}</label>
                <div>{!! $offer->description !!}</div>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">{{ __('Skills Type') }}</label>
                <p>{{ $offer->skills_type }}</p>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">{{ __('Vacancies Number') }}</label>
                <p>{{ $offer->vacancies_number }}</p>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">{{ __('Active') }}</label>
                <p>{{ $offer->is_active ? __('Yes') : __('No') }}</p>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">{{ __('Time Periods') }}</label>
                @if ($offer->timePeriods->isNotEmpty())
                    <ul class="list-group">
                        @foreach ($offer->timePeriods as $period)
                            <li class="list-group-item">
                                <strong>{{ $period->start_date }}</strong> - <strong>{{ $period->end_date }}</strong>
                                <span class="text-muted">({{ $period->start_time }} - {{ $period->end_time }})</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ __('No Periods') }}</p>
                @endif
            </div>
        </div>

        <!-- Edit button -->
        <div class="mt-3 text-right">
            <a href="{{ route('admin_offer_edit', ['id' => $offer->id]) }}"
                class="btn btn-warning">{{ __('Edit') }}</a>
        </div>
    </div>
@endsection
