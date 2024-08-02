@extends('layouts.guest')

@section('title', __('One News'))

@section('style')
    <style>
        .header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/storage/common/BgusTKIorv14R5WHlfXUy5FZYKwEbkauxbHsxIAP.jpg') center/cover no-repeat;
        }

        .news-item {
            display: flex;
            flex-direction: row;
            align-items: center;
            border-bottom: 1px solid #e3e3e3;
            padding: 2em;
            color: dark !important;
        }

        .news-item img {
            max-width: 250px;
            margin-right: 2em;
            object-fit: cover;
        }

        .news-item .news-content {
            flex: 1;
            margin-right: 2em;
            padding-top: 2em;
        }

        .bg-darker {
            background-color: #f5f5dc !important;
        }

        .bg-lighter {
            background-color: #f5f5f1 !important;
        }

        /* Адаптивная верстка для узких экранов */
        @media (max-width: 768px) {
            .news-item {
                flex-direction: column;
                text-align: center;
            }

            .news-item img {
                margin: 0 0 1em 0;
                max-width: 100%;
            }

            .news-item .news-content {
                margin: 0;
                padding-top: 0;
            }
        }

        .full-news-content {
            padding: 2em;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <section class="content-section" style="min-height: 60em; margin-top: 2em;">
        <div class="container mt-5">
            <h2 class="text-center mb-4">{{ __('Новина') }}</h2>
            <div class="news-item bg-darker">
                <img src="{{ $newsItem->photo }}" alt="{{ $newsItem->title }}" class="img-fluid">
                <div class="news-content">
                    <h3>{{ $newsItem->title }}</h3>
                    <p><small class="text-muted">{{ $newsItem->date }} {{ $newsItem->time }}</small></p>
                </div>
            </div>
            <div class="full-news-content mt-4">
                <p>{{ $newsItem->full_content }}</p>
            </div>
            <a href="{{ route('guest_news_list') }}" class="btn btn-primary mt-4">{{ __('Назад до новин') }}</a>
        </div>
    </section>
@endsection
