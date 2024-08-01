@extends('layouts.admin_layout')

@section('title', $newsItem->title)

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">{{ $newsItem->title }}</h2>
    <div class="row">
        <div class="col-md-12">
            @if ($newsItem->photo)
                <img src="{{ asset('storage/' . $newsItem->photo) }}" alt="{{ $newsItem->title }}" class="img-fluid rounded mb-4">
            @endif
            <p class="text-muted">{{ $newsItem->date }} {{ $newsItem->time }}</p>
            <div class="mb-4">
                <p>{{ $newsItem->short_content }}</p>
            </div>
            <div>
                <p>{!! nl2br(e($newsItem->full_content)) !!}</p>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">{{ __('Back to News List') }}</a>
    </div>
</div>
@endsection
