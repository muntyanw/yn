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
        </div>

        <div class="form-group">
            <label for="image">{{ __('Image') }}</label>
            @if($offer->image)
                <div class="mb-2">
                    <img id="current-image" src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->title }}" style="width: 150px; height: 150px;">
                </div>
                <p>{{ __('Current Image') }}</p>
            @else
                <p>{{ __('No current image') }}</p>
            @endif
            <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
            <div id="image-preview" class="mt-2"></div>
        </div>

        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea class="form-control" id="description" name="description" rows="5">{{ $offer->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="skills">{{ __('Skills') }}</label>
            <select multiple class="form-control" id="skills" name="skills[]">
                @foreach($skills as $skill)
                    <option value="{{ $skill->id }}" @if($offer->skills->contains($skill->id)) selected @endif>{{ $skill->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="skills_type">{{ __('Skills Type') }}</label>
            <input type="text" class="form-control" id="skills_type" name="skills_type" value="{{ $offer->skills_type }}" required>
        </div>

        <div class="form-group">
            <label for="vacancies">{{ __('Vacancies') }}</label>
            <input type="number" class="form-control" id="vacancies" name="vacancies" value="{{ $offer->vacancies }}" required>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" @if($offer->is_active) checked @endif>
            <label class="form-check-label" for="is_active">{{ __('Active') }}</label>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>

@section('scripts')
<script>
    function previewImage() {
        var file = document.getElementById('image').files[0];
        var preview = document.getElementById('image-preview');

        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '150px';
                img.style.height = '150px';
                preview.innerHTML = '';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    }
</script>
@endsection

@endsection
