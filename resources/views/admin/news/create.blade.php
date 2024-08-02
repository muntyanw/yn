@extends('layouts.admin_layout')

@section('title', __('Create News'))

@section('content')
    <div class="container mt-5">
        <h2>{{ __('Додати новину') }}</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="date" class="form-label">{{ __('Дата') }}</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">{{ __('Час') }}</label>
                <input type="time" class="form-control" id="time" name="time" value="{{ old('time') }}" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">{{ __('Заголовок') }}</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="mb-3">
                <label for="short_content" class="form-label">{{ __('Короткий зміст') }}</label>
                <textarea class="form-control" id="short_content" name="short_content" rows="3" required>{{ old('short_content') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="full_content" class="form-label">{{ __('Повний зміст') }}</label>
                <textarea class="form-control" id="full_content" name="full_content" rows="5" required>{{ old('full_content') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">{{ __('Фото') }}</label>
                <input type="file" class="form-control mb-2" id="photo" name="photo" onchange="previewImage(event)">
                <label for="photo_url" class="form-label">{{ __('Посилання на фото') }}</label>
                <input type="text" class="form-control" id="photo_url" name="photo_url" placeholder="https://example.com/photo.jpg" oninput="previewImageFromUrl()">
                <img id="preview" src="#" alt="{{ __('Попередній перегляд фото') }}" class="img-fluid mt-2" style="display: none;">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Зберегти') }}</button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        function previewImageFromUrl() {
            const url = document.getElementById('photo_url').value;
            const output = document.getElementById('preview');
            output.src = url;
            output.style.display = 'block';
        }
    </script>
@endsection
