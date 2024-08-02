@extends('layouts.guest')

@section('title', __('Volunteer Details'))

@section('style')
    <style>
        .header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/storage/common/BgusTKIorv14R5WHlfXUy5FZYKwEbkauxbHsxIAP.jpg') center/cover no-repeat;
        }

        .volunteer-photo {
            height: 300px;
            width: auto;
            aspect-ratio: 1.618;
            /* Golden ratio */
            object-fit: cover;
            object-position: top;
        }
    </style>
@endsection

@section('content')

    <section class="content-section" style="min-height: 60em; margin-top: 4em;">
        <div class="container">
            <h2 class="section-heading text-center">{{ __('Volunteer Details') }}</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ $volunteer->photo }}"
                                alt="{{ $volunteer->first_name }} {{ $volunteer->last_name }}"
                                class="img-fluid rounded volunteer-photo mb-4">
                            <h3>{{ $volunteer->first_name }} {{ $volunteer->last_name }}</h3>
                            {{-- <p><strong>{{ __('Phone') }}:</strong> {{ $volunteer->phone }}</p> --}}
                            {{-- <p><strong>{{ __('Email') }}:</strong> {{ $volunteer->email }}</p>
                            <p><strong>{{ __('Address') }}:</strong> {{ $volunteer->address }}</p> --}}
                            <p><strong>{{ __('About Me') }}:</strong> {{ $volunteer->about_me }}</p>
                            {{-- <p><strong>{{ __('Skills') }}:</strong>
                                {{ $volunteer->skills->pluck('name')->implode(', ') }}</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
