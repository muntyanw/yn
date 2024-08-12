@extends('layouts.admin_layout')

@section('title', __('Financial Reports'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{ __('Financial Reports') }}</h2>
        <a href="{{ route('admin_financial_reports_create') }}" class="btn btn-primary">{{ __('Add New Financial Report') }}</a>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>{{ __('Year') }}</th>
                <th>{{ __('Comment') }}</th>
                <th>{{ __('Files') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($financialReports as $report)
                <tr id="report-{{ $report->id }}">
                    <td>{{ $report->year }}</td>
                    <td>{{ $report->comment }}</td>
                    <td>
                        @if($report->files->isNotEmpty())
                            <ul>
                                @foreach($report->files as $file)
                                    <li><a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ __('View File') }}</a></li>
                                @endforeach
                            </ul>
                        @else
                            {{ __('No Files Attached') }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin_financial_reports_show', ['year' => $report->year]) }}" class="btn btn-info btn-sm">{{ __('View') }}</a>
                        <a href="{{ route('admin_financial_reports_edit', ['id' => $report->id]) }}" class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                        <button class="btn btn-danger btn-sm" onclick="deleteReport({{ $report->id }})">{{ __('Delete') }}</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">{{ __('No financial reports found') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Пагинация -->
    <div class="d-flex justify-content-center mt-4">
        {{ $financialReports->links() }}
    </div>
</div>

<script>
    function deleteReport(reportId) {
    if (!confirm('{{ __('Are you sure you want to delete this report?') }}')) return;

    fetch(`/admin_panel/financial-reports-delete/${reportId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Financial report deleted successfully.');
            document.getElementById(`report-${reportId}`).remove(); // Удаление строки из таблицы
        } else {
            alert('An error occurred: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An unexpected error occurred.');
    });
}
</script>
@endsection
