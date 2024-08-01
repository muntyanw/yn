@extends('layouts.admin_layout')

@section('title', __('Edit News'))

@section('content')
    <div class="container mt-5">
        <h2>{{ __('Редагувати новину') }}</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="date" class="form-label">{{ __('Дата') }}</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $news->date }}" required>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">{{ __('Час') }}</label>
                <input type="time" class="form-control" id="time" name="time" value="{{ $news->time }}" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">{{ __('Заголовок') }}</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}" required>
            </div>
            <div class="mb-3">
                <label for="short_content" class="form-label">{{ __('Короткий зміст') }}</label>
                <textarea class="form-control" id="short_content" name="short_content" rows="3" required>{{ $news->short_content }}</textarea>
            </div>
            <div class="mb-3">
                <label for="full_content" class="form-label">{{ __('Повний зміст') }}</label>
                <textarea class="form-control" id="full_content" name="full_content" rows="5" required>{{ $news->full_content }}</textarea>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">{{ __('Фото') }}</label>
                <input type="file" class="form-control" id="photo" name="photo" onchange="previewImage(event)">
                <input type="text" class="form-control mt-2" id="photo_url" name="photo_url" placeholder="URL або шлях до фото">
                @if ($news->photo)
                    <img id="preview" src="{{ $news->photo }}" alt="{{ $news->title }}" class="img-fluid mt-2">
                @else
                    <img id="preview" src="#" alt="{{ __('Попередній перегляд фото') }}" class="img-fluid mt-2" style="display: none;">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Зберегти') }}</button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const fileInput = event.target;
            const urlInput = document.getElementById('photo_url');
            const preview = document.getElementById('preview');

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }

            urlInput.value = ''; // Clear URL input if file is selected
        }

        document.getElementById('photo_url').addEventListener('input', function(event) {
            const url = event.target.value;
            const fileInput = document.getElementById('photo');
            const preview = document.getElementById('preview');

            if (url) {
                preview.src = url;
                preview.style.display = 'block';
                fileInput.value = ''; // Clear file input if URL is provided
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
