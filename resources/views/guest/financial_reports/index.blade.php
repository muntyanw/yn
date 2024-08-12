@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Финансовые отчеты</h1>
    <div class="years">
        @foreach($years as $year)
            <button class="year-btn" data-year="{{ $year->year }}">{{ $year->year }}</button>
        @endforeach
    </div>

    <div id="report-details">
        @include('financial_reports.partials.form', ['report' => $latestReport])
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.year-btn').forEach(button => {
            button.addEventListener('click', function() {
                let year = this.getAttribute('data-year');
                fetch(`/financial-reports/show/${year}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('report-details').innerHTML = generateReportForm(data);
                    });
            });
        });
    });

    function generateReportForm(report) {
        let filesHtml = '';
        report.files.forEach(file => {
            filesHtml += `<div>${file.file_path} <form method="POST" action="/financial-reports/file/${file.id}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
            </form></div>`;
        });

        return `
            <form method="POST" action="/financial-reports/store-or-update/${report.id}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="year">Год</label>
                    <input type="number" name="year" class="form-control" value="${report.year}" required>
                </div>
                <div class="form-group">
                    <label for="comment">Комментарий</label>
                    <textarea name="comment" class="form-control">${report.comment}</textarea>
                </div>
                <div class="form-group">
                    <label for="files">Файлы</label>
                    <input type="file" name="files[]" class="form-control" multiple>
                    <div class="mt-2">
                        ${filesHtml}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        `;
    }
</script>
@endsection
