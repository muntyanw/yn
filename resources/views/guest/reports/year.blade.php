@extends('layouts.guest')

@section('title', __('Reports for') . ' ' . $year)

@section('style')
    <style>
        .header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/storage/common/BgusTKIorv14R5WHlfXUy5FZYKwEbkauxbHsxIAP.jpg') center/cover no-repeat;
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
            cursor: pointer;
        }

        .month:nth-child(1) { top: 5%; left: 50%; transform: translate(-50%, -50%); }
        .month:nth-child(2) { top: 18%; left: 77%; transform: translate(-50%, -50%); }
        .month:nth-child(3) { top: 50%; left: 95%; transform: translate(-50%, -50%); }
        .month:nth-child(4) { top: 82%; left: 77%; transform: translate(-50%, -50%); }
        .month:nth-child(5) { top: 95%; left: 50%; transform: translate(-50%, -100%); }
        .month:nth-child(6) { top: 82%; left: 23%; transform: translate(-50%, -50%); }
        .month:nth-child(7) { top: 50%; left: 5%; transform: translate(-50%, -50%); }
        .month:nth-child(8) { top: 18%; left: 23%; transform: translate(-50%, -50%); }

        .circle-inner {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="container mb-5" style="min-height: 60em;margin-top: 8em;">
        <h2 class="text-center mb-4">{{ __('Reports for') }} {{ $year }}</h2>
        <div class="circle-container">
            <div class="circle">
                @foreach ($reports as $report)
                    @php
                        $monthName = [
                            1 => __('January'), 2 => __('February'), 3 => __('March'), 4 => __('April'),
                            5 => __('May'), 6 => __('June'), 7 => __('July'), 8 => __('August'),
                            9 => __('September'), 10 => __('October'), 11 => __('November'), 12 => __('December')
                        ][$report->month];
                    @endphp
                    <div class="month" style="top: {{ 50 + 40 * sin(deg2rad($report->month * 30 - 90)) }}%; left: {{ 50 + 40 * cos(deg2rad($report->month * 30 - 90)) }}%;" onclick="window.location.href='{{ route('reports.showMonth', ['year' => $year, 'month' => $report->month]) }}'">{{ $monthName }}</div>
                @endforeach
            </div>
            <div class="circle-inner">
                <h3>{{ $year }}</h3>
            </div>
        </div>
    </div>
@endsection
