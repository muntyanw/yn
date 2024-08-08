@extends('layouts.admin_layout')

@section('title', __('Reports'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ __('Reports') }}</h2>
            <a href="{{ route('admin_report_create') }}" class="btn btn-primary">{{ __('Add New Report') }}</a>
        </div>

        <!-- Поля для поиска -->
        <div class="mb-3 row">
            <div class="col">
                <input type="text" id="search" class="form-control" placeholder="{{ __('Search...') }}">
            </div>
            <div class="col">
                <input type="text" id="month_search" class="form-control" placeholder="{{ __('Search by month...') }}">
            </div>
            <div class="col">
                <input type="text" id="year_search" class="form-control" placeholder="{{ __('Search by year...') }}">
            </div>
        </div>

        <div id="reportTable">
            @include('admin.report.partials.table')
        </div>

        <!-- Пагинация -->
        <div class="d-flex justify-content-center mt-4">
            {{ $reports->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.sortable', function() {
            let sort = $(this).data('sort');
            let direction = $(this).data('direction');
            let newDirection = direction === 'asc' ? 'desc' : 'asc';

            $.ajax({
                url: '/admin_panel/reports',
                type: 'GET',
                data: {
                    sort: sort,
                    direction: newDirection,
                    search: $('#search').val(),
                    month_search: $('#month_search').val(),
                    year_search: $('#year_search').val()
                },
                success: function(data) {
                    $('#reportTable').html(data);
                    $('.sortable[data-sort="' + sort + '"]').data('direction', newDirection);
                }
            });
        });

        // Обработчики поиска
        $('#search').on('input', function() {
            let search = $(this).val();
            // if (search.length > 3) {
                $.ajax({
                    url: '/admin_panel/reports',
                    type: 'GET',
                    data: {
                        search: search,
                        month_search: $('#month_search').val(),
                        year_search: $('#year_search').val(),
                        sort: $('.sortable').data('sort'),
                        direction: $('.sortable').data('direction')
                    },
                    success: function(data) {
                        $('#reportTable').html(data);
                    }
                });
            // }
        });

        $('#month_search').on('input', function() {
            let monthSearch = $(this).val();
            $.ajax({
                url: '/admin_panel/reports',
                type: 'GET',
                data: {
                    search: $('#search').val(),
                    month_search: monthSearch,
                    year_search: $('#year_search').val(),
                    sort: $('.sortable').data('sort'),
                    direction: $('.sortable').data('direction')
                },
                success: function(data) {
                    $('#reportTable').html(data);
                }
            });
        });

        $('#year_search').on('input', function() {
            let yearSearch = $(this).val();
            $.ajax({
                url: '/admin_panel/reports',
                type: 'GET',
                data: {
                    search: $('#search').val(),
                    month_search: $('#month_search').val(),
                    year_search: yearSearch,
                    sort: $('.sortable').data('sort'),
                    direction: $('.sortable').data('direction')
                },
                success: function(data) {
                    $('#reportTable').html(data);
                }
            });
        });
    </script>
@endsection
