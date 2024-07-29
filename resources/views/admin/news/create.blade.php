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

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
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
                <input type="file" class="form-control" id="photo" name="photo">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Зберегти') }}</button>
        </form>
    </div>
@endsection
