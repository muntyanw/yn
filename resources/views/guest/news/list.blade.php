@extends('layouts.guest')

@section('title', __('News'))

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

        .news-item:nth-child(odd) {
            background-color: rgba(0, 0, 0, 0.5);
            color: rgb(79, 55, 6) !important;
        }

        .news-item:nth-child(even) {
            background-color: rgba(0, 0, 0, 0.3);
            color: rgb(79, 55, 6) !important;
        }

        .load-more-btn {
            display: block;
            margin: 2em auto;
            padding: 0.3em 2em;
            font-size: 1.2em;
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
    </style>
@endsection

@section('content')
    <section class="content-section" style="min-height: 60em; margin-top: 2em;">
        <div class="container mt-5">
            <h2 class="text-center mb-4">{{ __('Новини') }}</h2>
            <div id="news-container">
                <!-- Здесь будут загруженные новости -->
            </div>
            <button id="load-more-btn" class="btn btn-primary load-more-btn">{{ __('Ще новини') }}</button>
            <div class="d-flex justify-content-center mt-4">
                <div id="loading" style="display: none;">{{ __('Loading...') }}</div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let offset = 0;
            const newsContainer = document.getElementById('news-container');
            const loadingIndicator = document.getElementById('loading');
            const loadMoreBtn = document.getElementById('load-more-btn');

            function loadNews() {
                loadingIndicator.style.display = 'block';
                loadMoreBtn.style.display = 'none';

                fetch(`/news/fetch/${offset}`)
                    .then(response => response.json())
                    .then(data => {
                        loadingIndicator.style.display = 'none';
                        if (data.length > 0) {
                            data.forEach((newsItem, index) => {
                                const newsDiv = document.createElement('div');
                                newsDiv.classList.add('news-item');
                                if (index % 2 === 0) {
                                    newsDiv.classList.add('bg-darker', 'text-white');
                                } else {
                                    newsDiv.classList.add('bg-lighter', 'text-white');
                                }
                                newsDiv.innerHTML = `
                                    <img src="${newsItem.photo}" alt="${newsItem.title}" class="img-fluid">
                                    <div class="news-content">
                                        <h3>${newsItem.title}</h3>
                                        <p>${newsItem.short_content}</p>
                                        <p>
                                          <small class="text-muted">
                                             ${newsItem.date} ${newsItem.time}
                                             </small>
                                             <a href="/news/${newsItem.id}" class="btn btn-primary" style="margin-left:4em;">Детальніше</a>      
                                       </p>
                                    </div>
                                `;
                                newsContainer.appendChild(newsDiv);
                            });
                            offset += data.length;
                            loadMoreBtn.style.display = 'block';
                        } else {
                            loadMoreBtn.style.display = 'none';
                        }
                    });
            }

            loadMoreBtn.addEventListener('click', loadNews);

            loadNews();
        });
    </script>
@endsection
