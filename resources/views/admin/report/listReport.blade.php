@extends('layouts.admin_layout')

@section('title', __('Reports'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ __('Reports') }}</h2>
            <a href="{{ route('admin_report_create') }}" class="btn btn-primary">{{ __('Add New Report') }}</a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ __('Month') }}</th>
                    <th>{{ __('Year') }}</th>
                    <th>{{ __('Photos') }}</th>
                    <th>{{ __('Files') }}</th>
                    <th>{{ __('Text') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                    <tr>
                        <td>{{ $report->month }}</td>
                        <td>{{ $report->year }}</td>
                        <td>
                            @foreach($report->photos->take(3) as $photo)
                                <a href="{{ asset('storage/' . $photo->photo) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $photo->photo) }}" alt="Photo" class="img-thumbnail" width="100" />
                                </a>
                            @endforeach
                        </td>
                        <td>
                            @foreach($report->files as $file)
                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ basename($file->file_path) }}</a><br>
                            @endforeach
                        </td>
                        <td>
                            {{ Str::limit(strip_tags($report->text), 50, '...') }}
                        </td>
                        <td>
                            <a href="{{ route('admin_report_show', ['id' => $report->id]) }}"
                                class="btn btn-info btn-sm">{{ __('View') }}</a>
                            <a href="{{ route('admin_report_edit', ['id' => $report->id]) }}"
                                class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                            <form action="{{ route('admin_report_destroy', ['id' => $report->id]) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('{{ __('Are you sure you want to delete this report?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">{{ __('No reports found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Пагинация -->
        <div class="d-flex justify-content-center mt-4">
            {{ $reports->links() }}
        </div>
    </div>
@endsection
