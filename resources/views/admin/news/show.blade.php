@extends('layouts.admin_layout')

@section('title', __('Show News'))

@section('content')
    <div class="container mt-5">
        <h2>{{ $news->title }}</h2>
        <p><strong>{{ __('Дата') }}:</strong> {{ $news->date }}</p>
        <p><strong>{{ __('Час') }}:</strong> {{ $news->time }}</p>
        @if ($news->photo)
            <img src="{{ asset('storage/' . $news->photo) }}" alt="{{ $news->title }}" class="img-fluid mb-3">
        @endif
        <p><strong>{{ __('Короткий зміст') }}:</strong> {{ $news->short_content }}</p>
        <p><strong>{{ __('Повний зміст') }}:</strong> {!! nl2br(e($news->full_content)) !!}</p>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">{{ __('Назад') }}</a>
        <a href="{{ route('admin.news.edit', $news->id) }}" class="btn btn-warning btn-sm">{{ __('Редагувати') }}</a>
    </div>
@endsection
