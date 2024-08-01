@extends('layouts.admin_layout')

@section('title', __('Edit Volunteer'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('Edit Volunteer') }}</h2>
            <a href="{{ route('admin_volunteers_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <form action="{{ route('admin_volunteer_update', ['id' => $volunteer->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first_name">{{ __('First Name') }}</label>
                <input type="text" class="form-control" id="first_name" name="first_name"
                    value="{{ old('first_name', $volunteer->first_name) }}" required>
                @error('first_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="middle_name">{{ __('Middle Name') }}</label>
                <input type="text" class="form-control" id="middle_name" name="middle_name"
                    value="{{ old('middle_name', $volunteer->middle_name) }}">
                @error('middle_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name">{{ __('Last Name') }}</label>
                <input type="text" class="form-control" id="last_name" name="last_name"
                    value="{{ old('last_name', $volunteer->last_name) }}" required>
                @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="photo">{{ __('Photo') }}</label>
                @if ($volunteer->photo)
                    <div class="mb-2">
                        <img id="currentPhoto" src="{{ $volunteer->photo }}" alt="{{ $volunteer->first_name }}"
                            style="width: 150px; height: 150px;">
                    </div>
                    <p>{{ __('Current Photo') }}</p>
                @endif
                <input type="file" class="form-control" id="photo" name="photo" onchange="previewPhoto(event)">
                <img id="previewImage" src="#" alt="Preview" style="display: none; width: 150px; height: 150px;">
                <p>{{ __('OR') }}</p>
                <input type="text" class="form-control" id="photo_url" name="photo_url"
                    placeholder="Enter URL for the photo" value="{{ old('photo_url', $volunteer->photo) }}"
                    oninput="previewPhotoUrl()">
                @error('photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('photo_url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">{{ __('Phone') }}</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="{{ old('phone', $volunteer->phone) }}" required>
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $volunteer->email) }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">{{ __('Address') }}</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ old('address', $volunteer->address) }}">
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="about_me">{{ __('About Me') }}</label>
                <textarea class="form-control" id="about_me" name="about_me">{{ old('about_me', $volunteer->about_me) }}</textarea>
                @error('about_me')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="is_employee">{{ __('Is Employee') }}</label>
                <input type="checkbox" id="is_employee" name="is_employee"
                    {{ old('is_employee', $volunteer->is_employee) ? 'checked' : '' }}>
                @error('is_employee')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="public_access">{{ __('Public Access') }}</label>
                <input type="checkbox" id="public_access" name="public_access"
                    {{ old('public_access', $volunteer->public_access) ? 'checked' : '' }}>
                @error('public_access')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="skills">{{ __('Skills') }}</label>
                <select multiple class="form-control" id="skills" name="skills[]">
                    @foreach ($skills as $skill)
                        <option value="{{ $skill->id }}" @if (in_array($skill->id, old('skills', $volunteer->skills->pluck('id')->toArray()))) selected @endif>
                            {{ $skill->name }}</option>
                    @endforeach
                </select>
                @error('skills')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        function previewPhoto(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('previewImage');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewPhotoUrl() {
            var photoUrl = document.getElementById('photo_url').value;
            var output = document.getElementById('previewImage');
            output.src = photoUrl;
            output.style.display = 'block';
        }
    </script>
@endsection
