@extends('layouts.admin_layout')

@section('title', __('Edit Volunteer'))

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
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $volunteer->first_name }}" required>
        </div>

        <div class="form-group">
            <label for="middle_name">{{ __('Middle Name') }}</label>
            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $volunteer->middle_name }}">
        </div>

        <div class="form-group">
            <label for="last_name">{{ __('Last Name') }}</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $volunteer->last_name }}" required>
        </div>

        <div class="form-group">
            <label for="photo">{{ __('Photo') }}</label>
            @if($volunteer->photo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $volunteer->photo) }}" alt="{{ $volunteer->first_name }}" style="width: 150px; height: 150px;">
                </div>
                <p>{{ __('Current Photo') }}</p>
            @endif
            <input type="file" class="form-control" id="photo" name="photo">
        </div>

        <div class="form-group">
            <label for="phone">{{ __('Phone') }}</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $volunteer->phone }}" required>
        </div>

        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $volunteer->email }}" required>
        </div>

        <div class="form-group">
            <label for="address">{{ __('Address') }}</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $volunteer->address }}">
        </div>

        <div class="form-group">
            <label for="skills">{{ __('Skills') }}</label>
            <select multiple class="form-control" id="skills" name="skills[]">
                @foreach($skills as $skill)
                    <option value="{{ $skill->id }}" @if($volunteer->skills->contains($skill->id)) selected @endif>{{ $skill->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>
@endsection
