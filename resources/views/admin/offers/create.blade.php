@extends('layouts.admin_layout')

@section('title', __('Create Offer'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Create Offer') }}</h2>
        <a href="{{ route('admin_offers_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    </div>

    <form action="{{ route('admin_offer_store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" class="form-control" id="title" name="title" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- <div class="form-group">
            <label for="image">{{ __('Image') }}</label>
            <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event)">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div id="imagePreview" class="mt-2"></div>
        </div> --}}

        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea class="form-control" id="description" name="description"></textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="skills">{{ __('Skills') }}</label>
            <select multiple class="form-control" id="skills" name="skills[]">
                @foreach($skills as $skill)
                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                @endforeach
            </select>
            @error('skills')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="vacancies_number">{{ __('Vacancies Number') }}</label>
            <input type="number" class="form-control" id="vacancies_number" name="vacancies_number" value="1" required>
            @error('vacancies_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="is_active">{{ __('Active') }}</label>
            <input type="checkbox" id="is_active" name="is_active" checked>
            @error('is_active')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div id="time-periods">
            <h3>{{ __('Time Periods') }}</h3>
            <div class="form-group">
                <label for="start_date_0">{{ __('Start Date') }}</label>
                <input type="date" name="time_periods[0][start_date]" id="start_date_0" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date_0">{{ __('End Date') }}</label>
                <input type="date" name="time_periods[0][end_date]" id="end_date_0" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="start_time_0">{{ __('Start Time') }}</label>
                <input type="time" name="time_periods[0][start_time]" id="start_time_0" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_time_0">{{ __('End Time') }}</label>
                <input type="time" name="time_periods[0][end_time]" id="end_time_0" class="form-control" required>
            </div>
        </div>
        <button type="button" id="add-time-period" class="btn btn-secondary">{{ __('Add Time Period') }}</button>

        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>

@section('scripts')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" width="150">`;
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = '';
            }
        }

        document.getElementById('add-time-period').addEventListener('click', function () {
            var index = document.querySelectorAll('#time-periods .form-group').length / 4;
            var timePeriods = document.getElementById('time-periods');

            var startDateGroup = document.createElement('div');
            startDateGroup.className = 'form-group';
            startDateGroup.innerHTML = '<label for="start_date_' + index + '">{{ __('Start Date') }}</label>' +
                '<input type="date" name="time_periods[' + index + '][start_date]" id="start_date_' + index + '" class="form-control" required>';
            timePeriods.appendChild(startDateGroup);

            var endDateGroup = document.createElement('div');
            endDateGroup.className = 'form-group';
            endDateGroup.innerHTML = '<label for="end_date_' + index + '">{{ __('End Date') }}</label>' +
                '<input type="date" name="time_periods[' + index + '][end_date]" id="end_date_' + index + '" class="form-control" required>';
            timePeriods.appendChild(endDateGroup);

            var startTimeGroup = document.createElement('div');
            startTimeGroup.className = 'form-group';
            startTimeGroup.innerHTML = '<label for="start_time_' + index + '">{{ __('Start Time') }}</label>' +
                '<input type="time" name="time_periods[' + index + '][start_time]" id="start_time_' + index + '" class="form-control" required>';
            timePeriods.appendChild(startTimeGroup);

            var endTimeGroup = document.createElement('div');
            endTimeGroup.className = 'form-group';
            endTimeGroup.innerHTML = '<label for="end_time_' + index + '">{{ __('End Time') }}</label>' +
                '<input type="time" name="time_periods[' + index + '][end_time]" id="end_time_' + index + '" class="form-control" required>';
            timePeriods.appendChild(endTimeGroup);
        });
    </script>
@endsection
@endsection
