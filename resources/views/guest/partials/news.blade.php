<div class="container mt-5">
   <h2 class="text-center mb-4">{{ __('Новини') }}</h2>

   <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
       <div class="carousel-inner" id="news-container">
           @foreach ($news as $key => $newsItem)
               <div class="carousel-item @if ($key == 0) active @endif">
                   <div class="row">
                       <div class="col-md-4">
                           <img src="{{ asset('storage/' . $newsItem->photo) }}" alt="{{ $newsItem->title }}" class="img-fluid rounded">
                           <h3>{{ $newsItem->title }}</h3>
                           <p>{{ $newsItem->short_content }}</p>
                           <p>{{ $newsItem->date }} {{ $newsItem->time }}</p>
                       </div>
                   </div>
               </div>
           @endforeach
       </div>
       <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
           <span class="carousel-control-prev-icon" aria-hidden="true"></span>
           <span class="visually-hidden">Previous</span>
       </button>
       <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
           <span class="carousel-control-next-icon" aria-hidden="true"></span>
           <span class="visually-hidden">Next</span>
       </button>
   </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let offset = 3;

        document.querySelector('.carousel-control-next').addEventListener('click', function() {
            fetch(`/news/fetch/${offset}`)
                .then(response => response.json())
                .then(data => {
                    let container = document.getElementById('news-container');
                    container.innerHTML = '';
                    data.forEach((newsItem, index) => {
                        let item = document.createElement('div');
                        item.classList.add('carousel-item');
                        if (index === 0) item.classList.add('active');

                        item.innerHTML = `
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="/storage/${newsItem.photo}" alt="${newsItem.title}" class="img-fluid rounded">
                                    <h3>${newsItem.title}</h3>
                                    <p>${newsItem.short_content}</p>
                                    <p>${newsItem.date} ${newsItem.time}</p>
                                </div>
                            </div>
                        `;
                        container.appendChild(item);
                    });
                    offset += 3;
                });
        });

        document.querySelector('.carousel-control-prev').addEventListener('click', function() {
            offset = Math.max(0, offset - 3);
            fetch(`/news/fetch/${offset}`)
                .then(response => response.json())
                .then(data => {
                    let container = document.getElementById('news-container');
                    container.innerHTML = '';
                    data.forEach((newsItem, index) => {
                        let item = document.createElement('div');
                        item.classList.add('carousel-item');
                        if (index === 0) item.classList.add('active');

                        item.innerHTML = `
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="/storage/${newsItem.photo}" alt="${newsItem.title}" class="img-fluid rounded">
                                    <h3>${newsItem.title}</h3>
                                    <p>${newsItem.short_content}</p>
                                    <p>${newsItem.date} ${newsItem.time}</p>
                                </div>
                            </div>
                        `;
                        container.appendChild(item);
                    });
                });
        });
    });
</script>
@endsection