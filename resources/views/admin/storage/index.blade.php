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

        <div class="accordion mt-4" id="accordionExample">
            @foreach ($files as $directory => $fileList)
                <div class="card mb-3">
                    <div class="card-header" id="heading{{ md5($directory) }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ md5($directory) }}" aria-expanded="true" aria-controls="collapse{{ md5($directory) }}">
                                {{ str_replace('public/', '', $directory) }}
                            </button>
                        </h2>
                    </div>
                    <div id="collapse{{ md5($directory) }}" class="collapse" aria-labelledby="heading{{ md5($directory) }}" data-parent="#accordionExample">
                        <div class="card-body">
                            @foreach ($fileList as $file)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center me-3">
                                        <img src="{{ Storage::url($file) }}" alt="{{ basename($file) }}" class="img-fluid" style="max-width: 100px; margin-right: 15px;">
                                        <div class="ms-3">
                                            <p class="mb-0">{{ basename($file) }}</p>
                                            <p class="mb-0">{{ \Carbon\Carbon::createFromTimestamp(Storage::lastModified($file))->toDateTimeString() }}</p>
                                            <a href="{{ Storage::url($file) }}" target="_blank">{{ Storage::url($file) }}</a>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <a href="{{ Storage::url($file) }}" target="_blank" class="btn btn-primary btn-sm me-2">{{ __('View') }}</a>
                                        <button class="btn btn-secondary btn-sm me-2" onclick="copyToClipboard('{{ Storage::url($file) }}')">{{ __('Copy Link') }}</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteFile('{{ Storage::url($file) }}')">{{ __('Delete') }}</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <form id="upload-form" action="{{ route('admin_storage_images_upload') }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="image">{{ __('Add Image to Common Folder') }}</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-primary mt-2">{{ __('Upload') }}</button>
        </form>

        <form id="download-form" action="{{ route('admin_storage_download_images') }}" method="POST" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="urls">{{ __('Here you insert links to images separated by commas, they are downloaded to our server and appear in the common folder') }}</label>
                <textarea name="urls" class="form-control" rows="10" id="urls"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">{{ __('Download') }}</button>
        </form>
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
                        body: JSON.stringify({
                            path: path
                        })
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
