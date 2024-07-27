<!-- resources/views/admin/skills/edit.blade.php -->
@extends('layouts.admin_layout')

@section('title', __('Edit Skill'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('Edit Skill') }}</h2>
            <a href="{{ route('admin_skills_list') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
        </div>

        <form action="{{ route('admin_skill_update', ['skill' => $skill->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $skill->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $skill->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>
@endsection
