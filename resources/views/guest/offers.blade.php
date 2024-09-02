@extends('layouts.guest')

@section('title', __('Requirements Volunteers'))

@section('style')
    <style>
        .header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/storage/news_photos/k2rNcgk64YDy06dAdXB4LN3nbv7mLeTg0T5TjUWL.jpg') center/cover no-repeat;
        }

        .btn-lg-custom {
            font-size: 1.25rem;
            padding: 1rem 2rem;
            margin: 1rem 0;
        }

        /* Стили для таблицы на мобильных устройствах */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }

            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 15px;
            }

            .table tbody tr td {
                display: block;
                text-align: right;
                font-size: 1rem;
                border-bottom: 1px solid #ddd;
            }

            .table tbody tr td:before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            .table tbody tr td:last-child {
                border-bottom: 0;
            }

            .volunteer-card img {
                height: 200px;
                width: 100%;
                object-fit: cover;
                object-position: top;
            }

            .volunteer-card {
                margin-bottom: 2em;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container mb-5" style="min-height: 60em; margin-top: 8em;">
        <h2 class="text-center mb-4">{{ __('Потрібні Волонтери') }}</h2>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>{{ __('No.') }}</th>
                        <th>{{ __('Specialization/type of work') }}</th>
                        <th>{{ __('Term') }}</th>
                        <th>{{ __('Time') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $offer)
                        <tr>
                            <td data-label="{{ __('No.') }}">{{ $loop->iteration }}</td>
                            <td data-label="{{ __('Specialization/type of work') }}">
                                {{ $offer->skills->pluck('name')->implode(', ') }}</td>
                            <td data-label="{{ __('Term') }}">
                                @foreach ($offer->timePeriods as $period)
                                    <div>{{ $period->start_date }} - {{ $period->end_date }}</div>
                                @endforeach
                            </td>
                            <td data-label="{{ __('Time') }}">
                                @foreach ($offer->timePeriods as $period)
                                    <div>{{ $period->start_time }} - {{ $period->end_time }}</div>
                                @endforeach
                            </td>
                            <td data-label="{{ __('Description') }}&nbsp;" style="text-align: justify;">
                                {!! $offer->description !!}
                            </td>
                            <td data-label="{{ __('Action') }}">
                                <a href="{{ route('guest_volunteer_help', ['offer_id' => $offer->id]) }}"
                                    class="btn btn-primary">{{ __('Хочу допомогти') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            <a href="{{ route('guest_want_become_volunteer') }}"
                class="btn btn-lg btn-primary btn-lg-custom me-3">{{ __('Хочу стати волонтером') }}</a>
        </div>

        <div class="container" style="margin-top: 1em;">
            <h2 class="text-center">{{ __('Already with us.') }}</h2>
            <div id="volunteerGrid" class="row">
                @foreach ($volunteers as $volunteer)
                    <div class="col-md-2 volunteer-card">
                        <a href="{{ route('guest_volunteer_show', $volunteer->id) }}">
                            <img src="{{ $volunteer->photo }}"
                                alt="{{ $volunteer->first_name }} {{ $volunteer->last_name }}" class="img-fluid rounded" style="object-fit: contain;">
                        </a>
                        <p class="text-center">
                            <a href="{{ route('guest_volunteer_show', $volunteer->id) }}">
                                {{ $volunteer->first_name }} {{ $volunteer->last_name }}
                            </a>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let offset = 12; // Initial offset
            let loading = false; // Flag to prevent multiple simultaneous requests

            window.addEventListener('scroll', function() {
                if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100 && !loading) {
                    loading = true;
                    fetch(`/volunteers/fetch?offset=${offset}`)
                        .then(response => response.json())
                        .then(data => {
                            let volunteerGrid = document.getElementById('volunteerGrid');

                            data.forEach(volunteer => {
                                let col = document.createElement('div');
                                col.classList.add('col-md-2', 'volunteer-card');

                                let imgLink = document.createElement('a');
                                imgLink.href = `/volunteers/${volunteer.id}`;
                                let img = document.createElement('img');
                                img.src = `${volunteer.photo}`;
                                img.alt = `${volunteer.first_name} ${volunteer.last_name}`;
                                img.classList.add('img-fluid', 'rounded');
                                imgLink.appendChild(img);

                                let nameLink = document.createElement('a');
                                nameLink.href = `/volunteers/${volunteer.id}`;
                                nameLink.textContent =
                                    `${volunteer.first_name} ${volunteer.last_name}`;

                                let p = document.createElement('p');
                                p.classList.add('text-center');
                                p.appendChild(nameLink);

                                col.appendChild(imgLink);
                                col.appendChild(p);
                                volunteerGrid.appendChild(col);
                            });

                            offset += data.length; // Increment offset for next batch
                            loading = false; // Allow new requests after the current one finishes
                        })
                        .catch(() => {
                            loading = false; // In case of an error, allow future requests
                        });
                }
            });
        });
    </script>
@endsection
