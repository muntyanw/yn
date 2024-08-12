@extends('layouts.admin_layout')

@section('title', __('Edit Report'))

@section('style')
    @include('admin.partials.ckeditorcss')
    <style>
        .dynamic-field {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ $report->id ? __('Edit Report') : __('Create Report') }}</h2>
            <a href="{{ route('admin_report_list') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <form id="reportForm" action="{{ route('admin_report_save', ['id' => $report->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if ($report->id)
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="month">{{ __('Month') }}</label>
                <input type="number" class="form-control" id="month" name="month"
                    value="{{ old('month', $report->month) }}" required>
                @error('month')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="year">{{ __('Year') }}</label>
                <input type="number" class="form-control" id="year" name="year"
                    value="{{ old('year', $report->year) }}" required>
                @error('year')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div id="dynamicFields">
                <div class="dynamic-field">
                    <div class="form-group">
                        <label for="text">{{ __('Text') }}</label>
                        <textarea class="form-control ckeditor" name="texts[]" rows="5" required>
                            {{ old('text', $report->text) }}
                        </textarea>
                        @error('texts.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="photo">{{ __('Photo') }}</label>
                        <input type="file" class="form-control-file photo-upload" name="photosCK[]">
                        @error('photos.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="photo-preview mt-2"></div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" id="addField">{{ __('Add Another Block') }}</button>

            @if ($report->id)
                <div class="dynamic-field" style="margin-top: 2em;">
                    <div class="form-group">
                        <label for="photos">{{ __('Photos') }}</label>
                        <input type="file" class="form-control-file" id="photos" name="photos[]" multiple
                            onchange="previewImages(event)">
                        @error('photos.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <h4>{{ __('Current Photos') }}</h4>
                        @foreach ($report->photos as $photo)
                            <div class="mb-2 d-flex align-items-center">
                                <img src="{{ asset('storage/' . $photo->photo) }}" alt="{{ __('Current Photo') }}"
                                    class="img-thumbnail" width="150">
                                <a href="{{ asset('storage/' . $photo->photo) }}" target="_blank"
                                    class="btn btn-primary btn-sm"
                                    style="margin-left:1em;margin-right: 1em;">{{ __('View Image') }}</a>
                                <a href="javascript:deletePhoto('{{ $report->id }}', '{{ $photo->id }}');"
                                    class="btn btn-danger btn-sm">{{ __('Delete') }}</a>
                            </div>
                        @endforeach
                        <div id="photoPreviews" class="mt-3"></div>
                    </div>

                    <div class="mt-3">
                        <div class="form-group">
                            <label for="files">{{ __('Files') }}</label>
                            <input type="file" class="form-control-file" id="files" name="files[]" multiple
                                onchange="previewFiles(event)">
                            @error('files.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <h4>{{ __('Current Files') }}</h4>
                        @foreach ($report->files as $file)
                            <div class="mb-2 d-flex align-items-center">
                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                    class="btn btn-primary btn-sm">{{ __('View File') . ' ' . $file->file_path }}</a>
                                <a href="javascript:deleteFile('{{ $report->id }}', '{{ $file->id }}');"
                                    class="btn btn-danger btn-sm"
                                    style="margin-left:1em;margin-right: 1em;">{{ __('Delete') }}</a>
                            </div>
                        @endforeach
                        <div id="filePreviews" class="mt-3"></div>
                    </div>
                </div>
            @endif

            <div class="form-group">
                <label for="file_urls">{{ __('File URLs (one URL per line)') }}</label>
                <textarea name="file_urls" class="form-control" rows="3" placeholder="{{ __('Enter file URLs, one per line') }}">{{ old('file_urls') }}</textarea>
            </div>

            <div class="form-group mt-4">
                <button id="butsub" type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                <img id="waitico" src="/storage/img/loadingCircle.gif" style="display: none;width:4em;" />
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @include('admin.report.partials.editJs')
@endsection
