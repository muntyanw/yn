@extends('layouts.guest')

@section('title', __('Volunteers'))

@section('style')
    <style>
        .header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/storage/news_photos/k2rNcgk64YDy06dAdXB4LN3nbv7mLeTg0T5TjUWL.jpg') center/cover no-repeat;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: black;
            border-radius: 50%;
        }
        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }
        .carousel-item img {
            height: 300px;
            width: auto;
            aspect-ratio: 1.618; /* Golden ratio */
            object-fit: cover;
        }
    </style>
@endsection

@section('content')

    <section class="content-section" style="min-height: 60em; margin-top: 4em;">
        <div class="container">
            <h2 class="section-heading text-center">{{ __('Team') }}</h2>
            <div id="employeeCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            @foreach ($volunteers as $volunteer)
                                <div class="col-md-4">
                                    <a href="{{ route('guest_emploee_show', $volunteer->id) }}">
                                        <img src="{{ $volunteer->photo }}"
                                            alt="{{ $volunteer->first_name }} {{ $volunteer->last_name }}"
                                            class="img-fluid rounded"
                                            style="height: 300px; width: 100%; object-fit: cover;object-position: top;">
                                    </a>
                                    <p class="text-center">
                                        <a href="{{ route('guest_emploee_show', $volunteer->id) }}">
                                            {{ $volunteer->first_name }} {{ $volunteer->last_name }}
                                        </a>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#employeeCarousel"
                    data-bs-slide="prev" style="left: -7%;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#employeeCarousel"
                    data-bs-slide="next" style="right: -7%;">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let offset = 6; // Initial offset

            document.querySelector('.carousel-control-next').addEventListener('click', function() {
                fetch(`/volunteers/fetch?offset=${offset}`)
                    .then(response => response.json())
                    .then(data => {
                        let carouselInner = document.querySelector('.carousel-inner');
                        let newItem = document.createElement('div');
                        newItem.classList.add('carousel-item');

                        let row = document.createElement('div');
                        row.classList.add('row');

                        data.forEach(volunteer => {
                            let col = document.createElement('div');
                            col.classList.add('col-md-4');

                            let imgLink = document.createElement('a');
                            imgLink.href = `/volunteers/${volunteer.id}`;
                            let img = document.createElement('img');
                            img.src = `${volunteer.photo}`;
                            img.alt = `${volunteer.first_name} ${volunteer.last_name}`;
                            img.classList.add('img-fluid', 'rounded');
                            img.style.height = '300px';
                            img.style.width = '100%';
                            img.style.objectFit = 'cover';
                            imgLink.appendChild(img);

                            let nameLink = document.createElement('a');
                            nameLink.href = `/volunteers/${volunteer.id}`;
                            nameLink.textContent = `${volunteer.first_name} ${volunteer.last_name}`;

                            let p = document.createElement('p');
                            p.classList.add('text-center');
                            p.appendChild(nameLink);

                            col.appendChild(imgLink);
                            col.appendChild(p);
                            row.appendChild(col);
                        });

                        newItem.appendChild(row);
                        carouselInner.appendChild(newItem);

                        // Activate the new item
                        document.querySelectorAll('.carousel-item').forEach(item => item.classList.remove('active'));
                        newItem.classList.add('active');

                        offset += 6; // Increment offset for next batch
                    });
            });
        });
    </script>

@endsection
