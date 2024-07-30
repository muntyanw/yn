@extends('layouts.admin_layout')

@section('title', __('Edit Volunteer'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Edit Volunteer') }}</h2>
        <a href="{{ route('admin_volunteers_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    </div>

    <form action="{{ route('admin_volunteer_update', ['id' => $volunteer->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="first_name">{{ __('First Name') }}</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $volunteer->first_name) }}" required>
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="middle_name">{{ __('Middle Name') }}</label>
            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name', $volunteer->middle_name) }}">
            @error('middle_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name">{{ __('Last Name') }}</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $volunteer->last_name) }}" required>
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="photo">{{ __('Photo') }}</label>
            @if($volunteer->photo)
                <div class="mb-2">
                    <img id="currentPhoto" src="{{ asset('storage/' . $volunteer->photo) }}" alt="{{ $volunteer->first_name }}" style="width: 150px; height: 150px;">
                </div>
                <p>{{ __('Current Photo') }}</p>
            @endif
            <input type="file" class="form-control" id="photo" name="photo" onchange="previewPhoto(event)">
            <img id="previewImage" src="#" alt="Preview" style="display: none; width: 150px; height: 150px;">
            @error('photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">{{ __('Phone') }}</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $volunteer->phone) }}" required>
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $volunteer->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">{{ __('Address') }}</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $volunteer->address) }}">
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="skills">{{ __('Skills') }}</label>
            <select multiple class="form-control" id="skills" name="skills[]">
                @foreach($skills as $skill)
                    <option value="{{ $skill->id }}" @if(in_array($skill->id, old('skills', $volunteer->skills->pluck('id')->toArray()))) selected @endif>{{ $skill->name }}</option>
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
        reader.onload = function(){
            var output = document.getElementById('previewImage');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
