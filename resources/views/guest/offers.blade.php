@extends('layouts.guest')

@section('title', __('Requirements Volunteers'))

@section('style')
    <style>
        .header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/storage/common/BgusTKIorv14R5WHlfXUy5FZYKwEbkauxbHsxIAP.jpg') center/cover no-repeat;
        }

        .btn-lg-custom {
            font-size: 1.25rem;
            padding: 1rem 2rem;
            margin: 1rem 0;
        }
    </style>
@endsection

@section('content')
    <div class="container mb-5" style="min-height: 60em;margin-top: 8em;">
        <h2 class="text-center mb-4">{{ __('Потрібні Волонтери') }}</h2>

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
                            <a href="{{ route('guest_volunteer_help', ['offer_id' => $offer->id]) }}"
                                class="btn btn-primary">{{ __('Хочу допомогти') }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <div class="d-flex justify-content-center">
            <a href="{{ route('guest_volunteer_register') }}"
                class="btn btn-lg btn-primary btn-lg-custom me-3">{{ __('Хочу стати волонтером') }}</a>
            <a href=""
                class="btn btn-lg btn-success btn-lg-custom">{{ __('Кабінет волонтера') }}</a>
        </div> --}}


    </div>
@endsection