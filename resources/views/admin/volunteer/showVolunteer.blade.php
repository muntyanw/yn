@extends('layouts.admin_layout')

@section('title', __('Volunteer Details'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Volunteer Details') }}</h2>
        <a href="{{ route('admin_volunteers_list') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    </div>

    <div class="card">
        <div class="card-body">
            <h3>{{ $volunteer->first_name }} {{ $volunteer->middle_name }} {{ $volunteer->last_name }}</h3>
            @if($volunteer->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $volunteer->photo) }}" alt="{{ $volunteer->first_name }}" style="width: 150px; height: 150px;">
                </div>
            @endif
            <p><strong>{{ __('Phone') }}:</strong> {{ $volunteer->phone }}</p>
            <p><strong>{{ __('Email') }}:</strong> {{ $volunteer->email }}</p>
            <p><strong>{{ __('Address') }}:</strong> {{ $volunteer->address }}</p>
            <p><strong>{{ __('Skills') }}:</strong> {{ $volunteer->skills->pluck('name')->implode(', ') }}</p>
        </div>
    </div>
</div>
@endsection
