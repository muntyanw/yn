@extends('layouts.admin_layout')

@section('title', __('Edit Report'))

@section('style')
    @include('admin.partials.ckeditorcss')
@endsection

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('Edit Report') }}</h2>
            <a href="{{ route('admin_reports_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <form action="{{ route('admin_report_update', ['id' => $report->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="month">{{ __('Month') }}</label>
                <input type="number" class="form-control" id="month" name="month"
                    value="{{ old('month', $report->month) }}" required>
                @error('month')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="year">{{ __('Year') }}</label>
                <input type="number" class="form-control" id="year" name="year"
                    value="{{ old('year', $report->year) }}" required>
                @error('year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="text">{{ __('Text') }}</label>
                <textarea class="form-control" id="editor" name="text" required>{{ old('text', $report->text) }}</textarea>
                @error('text')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="photos">{{ __('Photos') }}</label>
                <input type="file" class="form-control-file" id="photos" name="photos[]" multiple
                    onchange="previewImages(event)">
                @error('photos.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-3">
                <h4>{{ __('Current Photos') }}</h4>
                @foreach ($report->photos as $photo)
                    <div class="mb-2 d-flex align-items-center">
                        <img src="{{ asset('storage/' . $photo->photo) }}" alt="{{ __('Current Photo') }}"
                            class="img-thumbnail" width="150">
                        <a href="{{ asset('storage/' . $photo->photo) }}" target="_blank"
                            class="ml-3">{{ __('View Image') }}</a>
                    </div>
                @endforeach
                <div id="photoPreviews" class="mt-3"></div>
            </div>

            <div class="form-group">
                <label for="files">Files</label>
                <input type="file" name="files[]" class="form-control-file" multiple>
            </div>

            <div class="form-group">
                <label for="file_urls">File URLs (одне посилання на одной строці)</label>
                <textarea name="file_urls" class="form-control" rows="3" placeholder="Enter file URLs, one per line"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>
@endsection

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
    @include('admin.partials.ckeditorjs')
@endsection
