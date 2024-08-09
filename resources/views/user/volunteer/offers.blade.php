@extends('layouts.app')

@section('title', __('Offers'))

@section('style')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn-primary');
            buttons.forEach(button => {
                button.addEventListener('click', function(event) {
                    @if (!Auth::check())
                        event.preventDefault();
                        window.location.href = '{{ route('login') }}';
                    @endif
                });
            });
        });
    </script>
@endsection

@section('content')
    <div class="container mb-5" style="min-height: 60em; margin-top: 1em;">
        <h2 class="text-center mb-4">{{ __('Потрібні Волонтери') }}</h2>

        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>{{ __('No.') }}</th>
                    <th>{{ __('Specialization/type of work') }}</th>
                    <th>{{ __('Term') }}</th>
                    <th>{{ __('Time') }}</th>
                    <th>{{ __('Description') }}</th>
                    {{-- <th>{{ __('Action') }}</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $offer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $offer->skills->pluck('name')->implode(', ') }}</td>
                        <td>
                            @foreach ($offer->timePeriods as $period)
                                <div>{{ $period->start_date }} - {{ $period->end_date }}</div>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($offer->timePeriods as $period)
                                <div>{{ $period->start_time }} - {{ $period->end_time }}</div>
                            @endforeach
                        </td>
                        <td>{{ $offer->description }}</td>
                        <td>
                            {{-- <form action="{{ route('guest_volunteer_help', ['offer_id' => $offer->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">{{ __('Хочу допомогти') }}</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
