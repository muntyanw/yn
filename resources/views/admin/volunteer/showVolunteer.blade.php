@extends('layouts.admin_layout')

@section('title', __('View Volunteer'))

@section('content')
<div class="container mt-5 mb-5">
    <h2>{{ __('View Volunteer') }}</h2>

    <div class="card">
        <div class="card-header">
            {{ __('Volunteer Details') }}
        </div>
        <div class="card-body">
            <p><strong>{{ __('Full Name') }}:</strong> {{ $volunteer->first_name }} {{ $volunteer->middle_name }} {{ $volunteer->last_name }}</p>
            <p><strong>{{ __('Phone') }}:</strong> {{ $volunteer->phone }}</p>
            <p><strong>{{ __('Address') }}:</strong> {{ $volunteer->address }}</p>
            <p><strong>{{ __('Photo') }}:</strong> <img src="{{ asset('storage/' . $volunteer->photo) }}" alt="Photo" style="width: 100px;"></p>
            <p><strong>{{ __('User') }}:</strong> <a href="{{ route('admin_users_show', $volunteer->user_id) }}">{{ $volunteer->user->name }}</a></p>
            <a href="{{ route('admin_volunteers_index') }}" class="btn btn-secondary">{{ __('Back to Volunteers') }}</a>
        </div>
    </div>
</div>
@endsection
