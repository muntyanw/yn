<!-- resources/views/reports/month.blade.php -->

<div class="report-details mt-4">
    <h3>{{ __('Report for') }} {{ \Carbon\Carbon::create()->month($report->month)->format('F') }} {{ $report->year }}</h3>
    <div>{!! $report->text !!}</div>

    @if ($report->photos->isNotEmpty())
        <div class="report-photos mt-4">
            <h4>{{ __('Photos') }}</h4>
            <div class="row">
                @foreach ($report->photos as $photo)
                    <div class="col-md-4 mb-4">
                        <img src="{{ asset('storage/' . $photo->photo) }}" alt="{{ __('Photo') }}" class="img-fluid img-thumbnail">
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if ($report->files->isNotEmpty())
        <div class="report-files mt-4">
            <h4>{{ __('Files') }}</h4>
            <ul>
                @foreach ($report->files as $file)
                    <li><a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">{{ basename($file->file_path) }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
