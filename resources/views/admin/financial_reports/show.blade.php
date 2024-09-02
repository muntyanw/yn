@extends('layouts.admin_layout')

@section('title', __('View Financial Report'))

@section('content')
    <div class="container mt-5">
        <h2>{{ __('Financial Report for Year') }}: {{ $financialReport->year }}</h2>

        <div class="form-group">
            <label>{{ __('Year') }}:</label>
            <p>{{ $financialReport->year }}</p>
        </div>

        <div class="form-group">
            <label>{{ __('Comment') }}:</label>
            <p>{{ $financialReport->comment }}</p>
        </div>

        <div class="form-group">
            <label>{{ __('Files') }}:</label>
            @if ($financialReport->files->isNotEmpty())
                <ul>
                    @foreach ($financialReport->files as $file)
                        <li><a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ __('View File') }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>{{ __('No Files Attached') }}</p>
            @endif
        </div>

        <a href="{{ route('admin_financial_reports_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    </div>
@endsection
