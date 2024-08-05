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

        .circle-container {
            position: relative;
            width: 300px;
            height: 300px;
            margin: 0 auto;
            border-radius: 50%;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .circle {
            position: absolute;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            border: 20px solid #007bff;
        }
        .month {
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: #fff;
            font-size: 14px;
            font-weight: bold;
        }
        .month:nth-child(1) { top: 5%; left: 50%; transform: translate(-50%, -50%); }
        .month:nth-child(2) { top: 18%; left: 77%; transform: translate(-50%, -50%); }
        .month:nth-child(3) { top: 50%; left: 95%; transform: translate(-50%, -50%); }
        .month:nth-child(4) { top: 82%; left: 77%; transform: translate(-50%, -50%); }
        .month:nth-child(5) { top: 95%; left: 50%; transform: translate(-50%, -50%); }
        .month:nth-child(6) { top: 82%; left: 23%; transform: translate(-50%, -50%); }
        .month:nth-child(7) { top: 50%; left: 5%; transform: translate(-50%, -50%); }
        .month:nth-child(8) { top: 18%; left: 23%; transform: translate(-50%, -50%); }
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

        <div class="d-flex justify-content-center">
            <a href="{{ route('guest_want_become_volunteer') }}"
                class="btn btn-lg btn-primary btn-lg-custom me-3">{{ __('Хочу стати волонтером') }}</a>
            {{-- <a href="{{ route('dashboard') }}"
                class="btn btn-lg btn-success btn-lg-custom">{{ __('Кабінет волонтера') }}</a> --}}
        </div>

    </div>
@endsection