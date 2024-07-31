@extends('layouts.admin_layout')

@section('title', __('Edit Offer'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('Edit Offer') }}</h2>
            <a href="{{ route('admin_offers_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <form action="{{ route('admin_offer_update', ['id' => $offer->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $offer->title }}"
                    required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">{{ __('Image') }}</label>
                @if ($offer->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->title }}" class="img-thumbnail"
                            width="150">
                    </div>
                    <p>{{ __('Current Image') }}</p>
                @endif
                <input type="file" class="form-control-file" id="image" name="image"
                    onchange="previewImage(event)">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div id="imagePreview" class="mt-2"></div>
            </div>

            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <textarea class="form-control" id="description" name="description" required>{{ old('description', $offer->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="skills">{{ __('Skills') }}</label>
                <select multiple class="form-control" id="skills" name="skills[]">
                    @foreach ($skills as $skill)
                        <option value="{{ $skill->id }}" @if (in_array($skill->id, $offer->skills->pluck('id')->toArray())) selected @endif>
                            {{ $skill->name }}</option>
                    @endforeach
                </select>
                @error('skills')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="vacancies_number">{{ __('Vacancies Number') }}</label>
                <input type="number" class="form-control" id="vacancies_number" name="vacancies_number"
                    value="{{ $offer->vacancies_number }}" required>
                @error('vacancies_number')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="is_active">{{ __('Active') }}</label>
                <input type="checkbox" id="is_active" name="is_active" @if ($offer->is_active) checked @endif>
                @error('is_active')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div id="time-periods">
                <h3>{{ __('Time Periods') }}</h3>
                @foreach ($offer->timePeriods as $index => $timePeriod)
                    <div class="border p-3 mb-3">
                        <div class="form-group">
                            <label for="start_date_{{ $index }}">{{ __('Start Date') }}</label>
                            <input type="date" name="time_periods[{{ $index }}][start_date]"
                                id="start_date_{{ $index }}" class="form-control"
                                value="{{ old('time_periods.' . $index . '.start_date', $timePeriod->start_date) }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="end_date_{{ $index }}">{{ __('End Date') }}</label>
                            <input type="date" name="time_periods[{{ $index }}][end_date]"
                                id="end_date_{{ $index }}" class="form-control"
                                value="{{ old('time_periods.' . $index . '.end_date', $timePeriod->end_date) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="start_time_{{ $index }}">{{ __('Start Time') }}</label>
                            <input type="time" name="time_periods[{{ $index }}][start_time]"
                                id="start_time_{{ $index }}" class="form-control"
                                value="{{ old('time_periods.' . $index . '.start_time', $timePeriod->start_time) }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="end_time_{{ $index }}">{{ __('End Time') }}</label>
                            <input type="time" name="time_periods[{{ $index }}][end_time]"
                                id="end_time_{{ $index }}" class="form-control"
                                value="{{ old('time_periods.' . $index . '.end_time', $timePeriod->end_time) }}" required>
                        </div>
                    </div>
                @endforeach
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

        document.getElementById('add-time-period').addEventListener('click', function() {
            var index = document.querySelectorAll('#time-periods .form-group').length / 4;
            var timePeriods = document.getElementById('time-periods');

            var periodContainer = document.createElement('div');
            periodContainer.className = 'border p-3 mb-3';

            var startDateGroup = document.createElement('div');
            startDateGroup.className = 'form-group';
            startDateGroup.innerHTML = '<label for="start_date_' + index + '">{{ __('Start Date') }}</label>' +
                '<input type="date" name="time_periods[' + index + '][start_date]" id="start_date_' + index +
                '" class="form-control" required>';
            periodContainer.appendChild(startDateGroup);

            var endDateGroup = document.createElement('div');
            endDateGroup.className = 'form-group';
            endDateGroup.innerHTML = '<label for="end_date_' + index + '">{{ __('End Date') }}</label>' +
                '<input type="date" name="time_periods[' + index + '][end_date]" id="end_date_' + index +
                '" class="form-control" required>';
            periodContainer.appendChild(endDateGroup);

            var startTimeGroup = document.createElement('div');
            startTimeGroup.className = 'form-group';
            startTimeGroup.innerHTML = '<label for="start_time_' + index + '">{{ __('Start Time') }}</label>' +
                '<input type="time" name="time_periods[' + index + '][start_time]" id="start_time_' + index +
                '" class="form-control" required>';
            periodContainer.appendChild(startTimeGroup);

            var endTimeGroup = document.createElement('div');
            endTimeGroup.className = 'form-group';
            endTimeGroup.innerHTML = '<label for="end_time_' + index + '">{{ __('End Time') }}</label>' +
                '<input type="time" name="time_periods[' + index + '][end_time]" id="end_time_' + index +
                '" class="form-control" required>';
            periodContainer.appendChild(endTimeGroup);

            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn btn-danger mt-2';
            removeButton.textContent = '{{ __('Remove') }}';
            removeButton.addEventListener('click', function() {
                periodContainer.remove();
            });
            periodContainer.appendChild(removeButton);

            timePeriods.appendChild(periodContainer);
        });
    </script>
@endsection
@endsection
