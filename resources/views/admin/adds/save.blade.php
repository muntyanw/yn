@extends('layouts.admin_layout')

@section('title', isset($addsPage) ? __('Edit Adds') : __('Create Adds'))

@section('style')
    <style>
        /* Стиль для лоадера */
        .loader {
            border: 4px solid #f3f3f3;
            /* Light grey */
            border-top: 4px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: none;
            /* Скрываем лоадер по умолчанию */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection

@section('content')
    <h1>{{ isset($addsPage) ? __('Edit Add') : __('Create Add') }}</h1>

    <div class="form-group">
        <label for="description">{{ __('Description') }}</label>
        <input type="text" id="description" class="form-control" value="{{ $addsPage->description ?? '' }}" required>
    </div>

    <div class="form-group">
        <label for="header_additions">{{ __('Additions to <header></header>') }}</label>
        <textarea id="header_additions" class="form-control">{{ $addsPage->header_additions ?? '' }}</textarea>
    </div>

    <div class="form-group">
        <label for="body_additions">{{ __('Additions to body') }}</label>
        <textarea id="body_additions" class="form-control">{{ $addsPage->body_additions ?? '' }}</textarea>
    </div>

    <div class="form-group">
        <label for="script_additions">{{ __('Additions to scripts') }}</label>
        <textarea id="script_additions" class="form-control">{{ $addsPage->script_additions ?? '' }}</textarea>
    </div>

    <div class="form-group">
        <label for="enabled">{{ __('Enabled') }}</label>
        <input type="checkbox" id="enabled" value="1"
            {{ isset($addsPage) && !$addsPage->enabled ? '' : 'checked' }}>
    </div>

    <button id="saveButton" class="btn btn-primary">
        {{ isset($addsPage) ? __('Update') : __('Create') }}
        <span class="loader" id="loader"></span>
    </button>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#saveButton').on('click', function() {
                // Показываем лоадер
                $('#loader').show();

                // Собираем данные
                let data = {
                    _token: '{{ csrf_token() }}',
                    description: $('#description').val(),
                    header_additions: $('#header_additions').val(),
                    body_additions: $('#body_additions').val(),
                    script_additions: $('#script_additions').val(),
                    enabled: $('#enabled').is(':checked') ? 1 : 0
                };

                let url =
                    '{{ isset($addsPage) ? route('adds_pages_save', $addsPage->id) : route('adds_pages_save') }}';
                let method = 'POST';

                $.ajax({
                    url: url,
                    type: method,
                    data: data,
                    success: function(response) {
                        if (response.errors) {
                            alert('{{ __('Error') }}: ' + JSON.stringify(response.errors));
                        } else {
                            alert(response.message);
                            window.location.href = '{{ route('adds_pages_index') }}';
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('{{ __('Error') }}:', error);
                    },
                    complete: function() {
                        // Скрываем лоадер
                        $('#loader').hide();
                    }
                });
            });
        });
    </script>
@endsection
