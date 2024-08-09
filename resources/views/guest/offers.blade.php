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
                            <td data-label="{{ __('Description') }}&nbsp;" style="text-align: justify;">{{ $offer->description }}
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
    </div>
@endsection
