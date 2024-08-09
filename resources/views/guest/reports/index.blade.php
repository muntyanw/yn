@extends('layouts.guest')

@section('title', __('Reports'))

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

        .report-content {
            display: none;
            background: #e6f2ff;
            padding: 2em;
            border-radius: 10px;
            margin-top: 2em;
            border: 3px solid white;
        }

        .btn-primary {
            background-color: #003366;
            border-color: #003366;
        }

        .btn-primary:hover {
            background-color: #002244;
            border-color: #002244;
        }

        .nav-tabs .nav-link {
            color: #0a61da !important;
        }

        .nav-tabs .nav-link.active {
            color: #495057;
        }

        .nav-tabs .nav-item .nav-link.inactive {
            color: #e3e3e3 !important;
        }

        .nav-tabs .nav-item .nav-link.inactive:hover {
            color: #e3e3e3 !important;
            cursor: not-allowed;
        }

        .nav-tabs .nav-item .nav-link {
            transition: background-color 0.2s, color 0.2s;
        }

        .nav-tabs .nav-item .nav-link:hover {
            background-color: #f0f5fe;
            color: #003366 !important;
        }

        @media (max-width: 992px) {
            
        }

        @media (min-width: 992px) {
            
        }
    </style>
@endsection

@section('content')
    <div class="container mb-5" style="min-height: 60em; margin-top: 8em;">
        <h2 class="text-center mb-4">{{ __('Reports') }}</h2>

        <ul class="nav nav-tabs mb-4">
            @foreach ($years as $year)
                <li class="nav-item">
                    <a class="nav-link @if ($loop->first) active @endif" href="#" data-year="{{ $year }}">{{ $year }}</a>
                </li>
            @endforeach
        </ul>

        <ul id="months-tabs" class="nav nav-tabs mb-4">
            @foreach (range(1, 12) as $month)
                <li class="nav-item">
                    <a class="nav-link @if (!$reportsByYear[$lastYear]->contains($month)) inactive @endif" href="#" data-month="{{ $month }}">
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
                </li>
            @endforeach
        </ul>

        <div id="report-content" class="report-content mt-4 reportcontwith" style="overflow: hidden;">
            <!-- Здесь будет содержимое отчета -->
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const monthsTabs = document.getElementById('months-tabs');
            const reportContent = document.getElementById('report-content');
            const navLinks = document.querySelectorAll('.nav-link[data-year]');
            const monthLinks = document.querySelectorAll('.nav-link[data-month]');

            function updateMonthStyles(year) {
                fetch(`/reports/months/${year}`)
                    .then(response => response.json())
                    .then(months => {
                        monthLinks.forEach(link => {
                            const monthNumber = link.dataset.month;
                            if (months.includes(parseInt(monthNumber))) {
                                link.classList.remove('inactive');
                            } else {
                                link.classList.add('inactive');
                            }
                        });

                        // Загрузить отчет за последний доступный месяц
                        const lastMonth = Math.max(...months);
                        const lastMonthLink = document.querySelector(`.nav-link[data-month="${lastMonth}"]`);
                        if (lastMonthLink) {
                            lastMonthLink.classList.add('active');
                            loadReport(year, lastMonth);
                        }
                    });
            }

            function loadReport(year, month) {
                fetch(`/reports/${year}/${month}`)
                    .then(response => response.text())
                    .then(html => {
                        reportContent.style.display = 'block';
                        reportContent.innerHTML = html;
                    });
            }

            monthLinks.forEach(month => {
                month.addEventListener('click', function() {
                    if (this.classList.contains('inactive')) return;

                    monthLinks.forEach(lnk => lnk.classList.remove('active'));
                    this.classList.add('active');

                    const monthNumber = this.dataset.month;
                    const year = document.querySelector('.nav-link[data-year].active').dataset.year;
                    loadReport(year, monthNumber);
                });
            });

            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(lnk => lnk.classList.remove('active'));
                    this.classList.add('active');
                    const year = this.dataset.year;

                    updateMonthStyles(year);
                });
            });

            // Initial update for the months
            const lastYearLink = navLinks[0];
            lastYearLink.classList.add('active');
            const lastYear = lastYearLink.dataset.year;

            fetch(`/reports/months/${lastYear}`)
                .then(response => response.json())
                .then(months => {
                    const lastMonth = Math.max(...months);
                    const lastMonthLink = document.querySelector(`.nav-link[data-month="${lastMonth}"]`);
                    if (lastMonthLink) {
                        lastMonthLink.classList.add('active');
                        loadReport(lastYear, lastMonth);
                    }
                });
        });
    </script>
@endsection
