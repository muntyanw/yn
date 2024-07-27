<!-- resources/views/admin/offers/create.blade.php -->

@extends('layouts.admin_layout')

@section('title', __('Create Offer'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('Create Offer') }}</h2>
            <a href="{{ route('admin_offers_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <form action="{{ route('admin_offer_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                    required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">{{ __('Image') }}</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="skills_type">{{ __('Skills Type') }}</label>
                <input type="text" class="form-control" id="skills_type" name="skills_type"
                    value="{{ old('skills_type') }}" required>
                @error('skills_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="vacancies">{{ __('Vacancies') }}</label>
                <input type="number" class="form-control" id="vacancies" name="vacancies"
                    value="{{ old('vacancies', 1) }}" required>
                @error('vacancies')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="is_active">{{ __('Active') }}</label>
                <input type="checkbox" id="is_active" name="is_active" value="1"
                    {{ old('is_active', 1) ? 'checked' : '' }}>
                @error('is_active')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>
@endsection
