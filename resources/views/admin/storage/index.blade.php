<!-- resources/views/storage/index.blade.php -->

@extends('layouts.admin_layout')

@section('title', __('Storage Files'))

@section('content')
    <div class="container mt-5">
        <h2>{{ __('Storage Files') }}</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form id="upload-form" action="{{ route('admin_storage_files_upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">{{ __('Add Image to Common Folder') }}</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
        </form>
        <div class="accordion mt-4" id="accordionExample">
            @foreach ($files as $directory => $fileList)
                <div class="card">
                    <div class="card-header" id="heading{{ md5($directory) }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapse{{ md5($directory) }}" aria-expanded="true"
                                aria-controls="collapse{{ md5($directory) }}">
                                {{ str_replace('public/', '', $directory) }}
                            </button>
                        </h2>
                    </div>
                    <div id="collapse{{ md5($directory) }}" class="collapse" aria-labelledby="heading{{ md5($directory) }}"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <table class="table table-striped table-hover w-100">
                                <thead>
                                    <tr>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('File Name') }}</th>
                                        <th>{{ __('Link') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fileList as $file)
                                        <tr>
                                            <td><img src="{{ Storage::url($file) }}" alt="{{ basename($file) }}" style="max-width: 100px;"></td>
                                            <td>{{ basename($file) }}</td>
                                            <td>{{ Storage::url($file) }}</td>
                                            <td>
                                                <a href="{{ Storage::url($file) }}" target="_blank" class="btn btn-primary btn-sm">{{ __('View') }}</a>
                                                <button class="btn btn-secondary btn-sm" onclick="copyToClipboard('{{ Storage::url($file) }}')">{{ __('Copy Link') }}</button>
                                                <button class="btn btn-danger btn-sm" onclick="deleteFile('{{ Storage::url($file) }}')">{{ __('Delete') }}</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            alert('{{ __('Link copied to clipboard') }}');
        }

        function deleteFile(path) {
            if (confirm('{{ __('Are you sure you want to delete this file?') }}')) {
                fetch('{{ route('admin_storage_files_delete') }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ path: path })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('{{ __('File deleted successfully') }}');
                        location.reload();
                    } else {
                        alert(data.message || '{{ __('File deletion failed') }}');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('{{ __('File deletion failed') }}');
                });
            }
        }

        document.getElementById('upload-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('{{ __('Image uploaded successfully') }}');
                    location.reload();
                } else {
                    alert('{{ __('Image upload failed') }}');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('{{ __('Image upload failed') }}');
            });
        });
    </script>
@endsection
