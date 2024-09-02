@extends('layouts.admin_layout')

@section('title', __('Edit Financial Report'))

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('Edit Financial Report') }}</h2>
            <a href="{{ route('admin_financial_reports_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>
        <form id="financialReportForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="year">{{ __('Year') }}</label>
                <input type="number" name="year" class="form-control" id="year" value="{{ $financialReport->year }}"
                    required>
            </div>
            <div class="form-group">
                <label for="comment">{{ __('Comment') }}</label>
                <textarea name="comment" class="form-control" id="comment">{{ $financialReport->comment }}</textarea>
            </div>
            <div class="form-group">
                <label for="files">{{ __('Files') }}</label>
                <input type="file" name="files[]" class="form-control" id="files" multiple>
                <div class="mt-2">
                    @if ($financialReport->files->isNotEmpty())
                        <ul>
                            @foreach ($financialReport->files as $file)
                                <li>
                                    <a href="{{ asset('storage/' . $file->file_path) }}"
                                        target="_blank">{{ __('View File') }}</a>
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="deleteFile({{ $file->id }})">{{ __('Delete') }}</button>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        {{ __('No Files') }}
                    @endif
                </div>
            </div>
            <button type="submit" id="submitButton" class="btn btn-primary">{{ __('Submit') }}</button>
            <div id="loader" class="spinner-border text-primary" role="status" style="display:none;">
                <span class="sr-only">Loading...</span>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('financialReportForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let submitButton = document.getElementById('submitButton');
            let loader = document.getElementById('loader');

            submitButton.disabled = true;
            loader.style.display = 'inline-block';

            fetch("{{ route('admin_financial_reports_storeOrUpdate', ['id' => $financialReport->id]) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Financial report updated successfully.');
                    } else {
                        alert('An error occurred while updating the financial report.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the financial report.');
                })
                .finally(() => {
                    submitButton.disabled = false;
                    loader.style.display = 'none';
                });
        });

        function deleteFile(fileId) {
            if (!confirm('{{ __('Are you sure you want to delete this file?') }}')) return;

            $.ajax({
                url: '{{ route('admin_financial_reports_delete-file') }}',
                type: 'DELETE',
                data: {
                    id: fileId, // Передаем ID файла как POST параметр
                    _method: 'DELETE', // Эмуляция метода DELETE
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        alert('File deleted successfully.');
                        location.reload(); // Перезагрузка страницы для обновления списка файлов
                    } else {
                        alert('An error occurred while deleting the file.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the file.');
                }
            });
        }
    </script>
@endsection
