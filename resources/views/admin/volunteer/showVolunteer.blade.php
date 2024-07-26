@extends('layouts.admin_layout')

@section('title', __('Volunteer Details'))

@section('content')
<div class="container mt-5 mb-5">
    <h2>{{ __('Volunteer Details') }}</h2>

    <div class="card">
        <div class="card-header">
            <h3>{{ $volunteer->first_name }} {{ $volunteer->last_name }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($volunteer->photo)
                        <img src="{{ asset('storage/' . $volunteer->photo) }}" alt="{{ $volunteer->first_name }}'s Photo" class="img-fluid">
                    @else
                        <img src="{{ asset('images/default-avatar.png') }}" alt="Default Photo" class="img-fluid">
                    @endif
                </div>
                <div class="col-md-8">
                    <p><strong>{{ __('First Name') }}:</strong> {{ $volunteer->first_name }}</p>
                    <p><strong>{{ __('Middle Name') }}:</strong> {{ $volunteer->middle_name }}</p>
                    <p><strong>{{ __('Last Name') }}:</strong> {{ $volunteer->last_name }}</p>
                    <p><strong>{{ __('Email') }}:</strong> {{ $volunteer->email }}</p>
                    <p><strong>{{ __('Phone') }}:</strong> {{ $volunteer->phone }}</p>
                    <p><strong>{{ __('Address') }}:</strong> {{ $volunteer->address }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin_volunteers_list') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>
    </div>
</div>
@endsection
