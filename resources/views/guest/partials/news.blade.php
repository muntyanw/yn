<div class="container mt-5">
    <h2 class="text-center mb-4">{{ __('Новини') }}</h2>

    <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" id="news-container">
            @foreach ($news->chunk(3) as $newsChunk)
                <div class="carousel-item @if ($loop->first) active @endif">
                    <div class="row">
                        @foreach ($newsChunk as $newsItem)
                            <div class="col-md-4">
                                <img src="{{ $newsItem->photo }}" alt="{{ $newsItem->title }}" class="img-fluid rounded"
                                    style="min-height: 19em;">
                                <h3>{{ $newsItem->title }}</h3>
                                <p>{{ $newsItem->short_content }}</p>
                                <p>{{ $newsItem->date }} {{ $newsItem->time }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev"
            style="margin-left: -7em;">
            <span class="carousel-control-prev-icon" aria-hidden="true"
                style="background-color: black;border-radius: 14px;"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next"
            style="margin-right: -7em;">
            <span class="carousel-control-next-icon" aria-hidden="true"
                style="background-color: black;border-radius: 14px;"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="row align-items-center justify-content-center" style="margin-bottom: 2em;">
        <a href="{{ route('guest_news_list') }}" class="btn btn-primary" style="width: 16em">Детальніше</a>
    </div>
</div>

@section('styles')
    <style>
        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 5%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .carousel-control-prev {
            left: -2%;
        }

        .carousel-control-next {
            right: -2%;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let offset = 3;

            function loadNews(offset) {
                fetch(`/news/fetch/${offset}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            let container = document.getElementById('news-container');
                            let activeItems = container.querySelectorAll('.carousel-item.active');

                            // Удаляем активный класс со всех текущих элементов
                            activeItems.forEach(item => {
                                item.classList.remove('active');
                            });

                            let chunkedData = chunkArray(data, 3);
                            chunkedData.forEach((newsChunk, chunkIndex) => {
                                let item = document.createElement('div');
                                item.classList.add('carousel-item');
                                if (chunkIndex === 0) item.classList.add('active');

                                let row = document.createElement('div');
                                row.classList.add('row');

                                newsChunk.forEach(newsItem => {
                                    let col = document.createElement('div');
                                    col.classList.add('col-md-4');
                                    col.innerHTML = `
                                        <img src="${newsItem.photo}" alt="${newsItem.title}" class="img-fluid rounded">
                                        <h3>${newsItem.title}</h3>
                                        <p>${newsItem.short_content}</p>
                                        <p>${newsItem.date} ${newsItem.time}</p>
                                    `;
                                    row.appendChild(col);
                                });

                                item.appendChild(row);
                                container.appendChild(item);
                            });

                            offset += 3;
                        }
                    });
            }

            function chunkArray(array, chunkSize) {
                const results = [];
                for (let i = 0; i < array.length; i += chunkSize) {
                    results.push(array.slice(i, i + chunkSize));
                }
                return results;
            }

            document.querySelector('.carousel-control-next').addEventListener('click', function() {
                loadNews(offset);
            });

            document.querySelector('.carousel-control-prev').addEventListener('click', function() {
                offset = Math.max(0, offset - 3);
                loadNews(offset);
            });
        });
    </script>
@endsection
