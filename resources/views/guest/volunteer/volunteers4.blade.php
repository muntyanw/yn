@section('style')
    <style>
        .volunteer-card img {
            height: 300px;
            width: 100%;
            object-fit: cover;
            object-position: top;
        }

        .volunteer-card {
            min-height: 300px;
            margin-bottom: 2em;
        }
    </style>
@endsection

@section('content')
    <section class="content-section" style="min-height: 60em; margin-top: 4em;">
        <div class="container">
            <h2 class="section-heading text-center">{{ __('Team') }}</h2>
            <div id="volunteerGrid" class="row">
                @php
                    $volunteers = \App\Models\Volunteer::limit(12)->get();
                @endphp
                @foreach ($volunteers as $volunteer)
                    <div class="col-md-3 volunteer-card">
                        <a href="{{ route('guest_volunteer_show', $volunteer->id) }}">
                            <img src="{{ $volunteer->photo }}" alt="{{ $volunteer->first_name }} {{ $volunteer->last_name }}"
                                class="img-fluid rounded">
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
    </section>
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
                                col.classList.add('col-md-3', 'volunteer-card');

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
