@extends('layouts.guest')

@section('title', __('Reports'))

@section('style')
    <style>
        .header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('/storage/common/BgusTKIorv14R5WHlfXUy5FZYKwEbkauxbHsxIAP.jpg') center/cover no-repeat;
        }

        .btn-lg-custom {
            font-size: 1.25rem;
            padding: 1rem 2rem;
            margin: 1rem 0;
        }

        .report-content {
            background: #e6f2ff;
            padding: 2em;
            border-radius: 10px;
            margin-top: 2em;
            border: 3px solid white;
        }

        .btn-primary {
            background-color: #0056b3;
            border-color: #004085;
            color: #fff;
            padding: 0.5rem 1.25rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-radius: 8px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #003366;
            border-color: #002244;
            color: #ffffff;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-outline-primary {
            color: #0056b3;
            border-color: #0056b3;
            padding: 0.4rem 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-radius: 8px;
            transition: color 0.3s ease, border-color 0.3s ease, background-color 0.3s ease;
        }

        .btn-outline-primary:hover {
            color: #fff;
            background-color: #0056b3;
            border-color: #004085;
        }

        .years-navigation,
        .months-navigation {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .years-navigation .btn,
        .months-navigation .btn {
            margin: 5px;
        }

        /* Стили для месяцев в желтых тонах */
        .months-navigation .btn {
            color: #FFD700;
            border-color: #FFD700;
            background-color: transparent;
            padding: 0.2rem 0.5rem;
            /* font-weight: bold; */
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-radius: 8px;
            transition: color 0.3s ease, border-color 0.3s ease, background-color 0.3s ease;
        }

        .months-navigation .btn:hover {
            color: #fff;
            background-color:#FFC107;
            border-color: #FFC107;
        }

        .months-navigation .btn.active {
            background-color: #b7950b;
            color: #fff;
            border-color: #a67c00;
        }
    </style>
@endsection

@section('content')
    <div class="container mb-5" style="min-height: 60em; margin-top: 8em;">
        <h2 class="text-center mb-4">{{ __('Reports') }}</h2>

        @if ($years->isNotEmpty())
            <!-- Линейка лет -->
            <div class="years-navigation">
                @foreach ($years as $year)
                    <a href="{{ route("guest_reports_year", ["year" => $year]) }}"
                        class="btn btn-outline-primary {{ $selectedYear == $year ? 'active' : '' }}">
                        {{ $year }}
                    </a>
                @endforeach
            </div>

            <!-- Линейка месяцев -->
            @if (!empty($reportsByYear))
                <div class="months-navigation">
                    @foreach (range(12, 1) as $month)
                        @if (in_array($month, $reportsByYear))
                            <a href="{{ route('guest_reports_month', ['year' => $selectedYear, 'month' => $month]) }}"
                                class="btn {{ $selectedMonth == $month ? 'active' : '' }}">
                                @switch($month)
                                    @case(1)
                                        {{ __('January') }}
                                    @break

                                    @case(2)
                                        {{ __('February') }}
                                    @break

                                    @case(3)
                                        {{ __('March') }}
                                    @break

                                    @case(4)
                                        {{ __('April') }}
                                    @break

                                    @case(5)
                                        {{ __('May') }}
                                    @break

                                    @case(6)
                                        {{ __('June') }}
                                    @break

                                    @case(7)
                                        {{ __('July') }}
                                    @break

                                    @case(8)
                                        {{ __('August') }}
                                    @break

                                    @case(9)
                                        {{ __('September') }}
                                    @break

                                    @case(10)
                                        {{ __('October') }}
                                    @break

                                    @case(11)
                                        {{ __('November') }}
                                    @break

                                    @case(12)
                                        {{ __('December') }}
                                    @break
                                @endswitch
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif

            @if (isset($report))
                <div id="report-content" class="report-content mt-4 reportcontwith">
                    <h3>{{ __('Report for') }}
                        {{ \Carbon\Carbon::create()->month($report->month)->locale('uk')->translatedFormat('F') }}
                        {{ $report->year }}</h3>
                    <div>{!! $report->text !!}</div>

                    @if ($report->photos->isNotEmpty())
                        <div class="report-photos mt-4">
                            <h4>{{ __('Photos') }}</h4>
                            <div class="row">
                                @foreach ($report->photos as $photo)
                                    <div class="col-md-4 mb-4">
                                        <img src="{{ asset('storage/' . $photo->photo) }}" alt="{{ __('Photo') }}"
                                            class="img-fluid img-thumbnail">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($report->files->isNotEmpty())
                        <div class="report-files mt-4 reportimgwith" style="overflow: hidden;">
                            <h4>{{ __('Files') }}</h4>
                            <ul>
                                @foreach ($report->files as $file)
                                    <li><a href="{{ asset('storage/' . $file->file_path) }}"
                                            target="_blank">{{ basename($file->file_path) }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @else
                <p>{{ __('No reports available for this month.') }}</p>
            @endif
        @else
            <p>{{ __('No reports available.') }}</p>
        @endif
    </div>
@endsection

