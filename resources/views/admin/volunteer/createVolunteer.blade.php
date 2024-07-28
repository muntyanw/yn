@extends('layouts.admin_layout')

@section('title', __('Create Volunteer'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Create Volunteer') }}</h2>
        <a href="{{ route('admin_volunteers_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    </div>

    <!-- Информация о пользователе -->
    @if($user)
    <div class="card mb-4">
        <div class="card-header">
            {{ __('User Information') }}
        </div>
        <div class="card-body">
            <p><strong>{{ __('Name') }}:</strong> {{ $user->name }}</p>
            <p><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
        </div>
    </div>
    @endif

    <form action="{{ route('admin_volunteer_store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Скрытое поле для передачи user_id -->
        <input type="hidden" name="user_id" value="{{ $user->id ?? '' }}">

        <div class="form-group">
            <label for="first_name">{{ __('First Name') }}</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="middle_name">{{ __('Middle Name') }}</label>
            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name') }}">
            @error('middle_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="last_name">{{ __('Last Name') }}</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="photo">{{ __('Photo') }}</label>
            <input type="file" class="form-control-file" id="photo" name="photo" onchange="previewImage()">
            @error('photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <!-- Место для отображения предварительного просмотра изображения -->
            <div id="photo-preview" class="mt-2">
                <img id="photo-preview-img" src="#" alt="Photo Preview" style="display:none; max-width: 100%; height: auto;">
            </div>
        </div>

        <div class="form-group">
            <label for="phone">{{ __('Phone') }}</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">{{ __('Address') }}</label>
            <textarea class="form-control" id="address" name="address" required>{{ old('address') }}</textarea>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>

@section('scripts')
<script>
    function previewImage() {
        const file = document.getElementById('photo').files[0];
        const preview = document.getElementById('photo-preview-img');
        const photoPreview = document.getElementById('photo-preview');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>
@endsection
@endsection
