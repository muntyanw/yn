@extends('layouts.admin_layout')

@section('title', __('Main'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Edit Volunteer') }}</h2>
        <a href="{{ route('admin_volunteers_list') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
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
            <input type="file" class="form-control-file" id="photo" name="photo" accept="image/*" onchange="previewImage(event)">
            @if($volunteer->photo)
                <img id="currentPhoto" src="{{ asset('storage/' . $volunteer->photo) }}" alt="{{ __('Current Photo') }}" class="img-thumbnail mt-2" width="150">
            @else
                <img id="currentPhoto" src="#" alt="{{ __('Current Photo') }}" class="img-thumbnail mt-2" width="150" style="display:none;">
            @endif
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
            <textarea class="form-control" id="address" name="address" required>{{ old('address', $volunteer->address) }}</textarea>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>

@section('scripts')
<script>
function previewImage(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    
    reader.onload = function(e) {
        const img = document.getElementById('currentPhoto');
        img.src = e.target.result;
        img.style.display = 'block';  // Показываем изображение
    }
    
    if (file) {
        reader.readAsDataURL(file);
    }
}
</script>
@endsection

@endsection
