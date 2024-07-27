<!-- resources/views/admin/reports/create.blade.php -->
@extends('layouts.admin_layout')

@section('title', __('Create Report'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('Create Report') }}</h2>
            <a href="{{ route('admin_reports_list') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <form action="{{ route('admin_report_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="month">{{ __('Month') }}</label>
                <input type="number" class="form-control" id="month" name="month" required>
                @error('month')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="year">{{ __('Year') }}</label>
                <input type="number" class="form-control" id="year" name="year" required>
                @error('year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="text">{{ __('Text') }}</label>
                <textarea class="form-control" id="text" name="text" required></textarea>
                @error('text')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="photos">{{ __('Photos') }}</label>
                <input type="file" class="form-control-file" id="photos" name="photos[]" multiple>
                @error('photos')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>
@endsection
