@extends('layouts.guest')

@section('title', __('Financial Reports'))

@section('style')
    <style>
        .header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('/storage/news_photos/k2rNcgk64YDy06dAdXB4LN3nbv7mLeTg0T5TjUWL.jpg') center/cover no-repeat;
        }
    </style>
@endsection

@section('content')
    <div class="container mb-5" style="min-height: 40em; margin-top: 8em;">
        @if ($availableYears->isNotEmpty())
            <!-- Линейка лет -->
            <div class="years-navigation mb-4">
                @foreach ($availableYears as $availableYear)
                    <a href="{{ route('guest_financial_reports_show', $availableYear->year) }}"
                        class="btn btn-outline-primary {{ isset($financialReport) && $availableYear->year == $financialReport->year ? 'active' : '' }}">
                        {{ $availableYear->year }}
                    </a>
                @endforeach
            </div>

            @if (isset($financialReport))
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>{{ __('Financial Report for Year') }}: {{ $financialReport->year }}</h2>
                </div>

                <div class="report-details">
                    <div class="form-group">
                        <p>{{ $financialReport->comment }}</p>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Files') }}:</label>
                        @if ($financialReport->files->isNotEmpty())
                            @foreach ($financialReport->files as $file)
                                <p>
                                    {{ str_replace('financial_reports/', '', $file->file_path) }}
                                    <a href="{{ asset('storage/' . $file->file_path) }}" class="btn btn-primary"
                                        target="_blank">{{ __('View File') . ' ' }}</a>

                                    <a href="{{ asset('storage/' . $file->file_path) }}" class="btn btn-success"
                                        download="{{ $file->file_path }}">{{ __('Download') }}</a>
                                </p>
                            @endforeach
                        @else
                            <p>{{ __('No Files Attached') }}</p>
                        @endif
                    </div>
                </div>
            @else
                <p>{{ __('No financial report available for the selected year.') }}</p>
            @endif
        @else
            <p>{{ __('No financial reports available.') }}</p>
        @endif
    </div>
@endsection
