@extends('layouts.admin_layout')

@section('title', __('Create Report'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Create Report') }}</h2>
        <a href="{{ route('admin_reports_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    </div>

    <form action="{{ route('admin_report_store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="month">{{ __('Month') }}</label>
            <input type="number" class="form-control" id="month" name="month" value="{{ old('month') }}" required>
            @error('month')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="year">{{ __('Year') }}</label>
            <input type="number" class="form-control" id="year" name="year" value="{{ old('year') }}" required>
            @error('year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="text">{{ __('Text') }}</label>
            <textarea class="form-control" id="text" name="text" required>{{ old('text') }}</textarea>
            @error('text')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="photos">{{ __('Photos') }}</label>
            <input type="file" class="form-control-file" id="photos" name="photos[]" multiple onchange="previewImages(event)">
            @error('photos.*')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-3">
            <h4>{{ __('Preview Photos') }}</h4>
            <div id="photoPreviews" class="mt-3"></div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>

@section('scripts')
<script>
    function previewImages(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('photoPreviews');
        previewContainer.innerHTML = ''; // Clear previous previews

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail';
                img.width = 150;

                const link = document.createElement('a');
                link.href = e.target.result;
                link.target = '_blank';
                link.className = 'ml-3';
                link.innerText = '{{ __('View Image') }}';

                const div = document.createElement('div');
                div.className = 'mb-2 d-flex align-items-center';
                div.appendChild(img);
                div.appendChild(link);

                previewContainer.appendChild(div);
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
@endsection
