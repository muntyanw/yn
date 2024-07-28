@extends('layouts.admin_layout')

@section('title', __('Edit Offer'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Edit Offer') }}</h2>
        <a href="{{ route('admin_offers_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    </div>

    <form action="{{ route('admin_offer_update', ['id' => $offer->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $offer->title }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">{{ __('Image') }}</label>
            @if($offer->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->title }}" class="img-thumbnail" width="150">
                </div>
                <p>{{ __('Current Image') }}</p>
            @endif
            <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event)">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div id="imagePreview" class="mt-2"></div>
        </div>

        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea class="form-control" id="description" name="description" required>{{ old('description', $offer->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="skills_type">{{ __('Skills Type') }}</label>
            <input type="text" class="form-control" id="skills_type" name="skills_type" value="{{ $offer->skills_type }}" required>
            @error('skills_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="vacancies">{{ __('Vacancies') }}</label>
            <input type="number" class="form-control" id="vacancies" name="vacancies" value="{{ $offer->vacancies }}" required>
            @error('vacancies')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="is_active">{{ __('Active') }}</label>
            <input type="checkbox" id="is_active" name="is_active" @if($offer->is_active) checked @endif>
            @error('is_active')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>

@section('scripts')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" width="150">`;
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = '';
            }
        }
    </script>
@endsection
@endsection
