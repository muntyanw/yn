<!-- resources/views/admin/reports/show.blade.php -->

@extends('layouts.admin_layout')

@section('title', __('View Report'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('View Report') }}</h2>
            <a href="{{ route('admin_reports_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('Month') }}</label>
                    <p>{{ $report->month }}</p>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('Year') }}</label>
                    <p>{{ $report->year }}</p>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('Text') }}</label>
                    <div>{!! $report->text !!}</div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">{{ __('Photos') }}</label>
                    <div class="row">
                        @foreach ($report->photos as $photo)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $photo->photo) }}" alt="{{ __('Photo') }}"
                                        class="card-img-top img-thumbnail">
                                    <div class="card-body">
                                        <p class="card-text">{{ $photo->html_link }}</p>
                                        <a href="{{ asset('storage/' . $photo->photo) }}" class="btn btn-primary btn-sm"
                                            target="_blank">{{ __('View Full Image') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
