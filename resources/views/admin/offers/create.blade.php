<!-- resources/views/admin/offers/create.blade.php -->

@extends('layouts.admin_layout')

@section('title', __('Create Offer'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Create Offer') }}</h2>
        <a href="{{ route('admin_offers_index') }}" class="btn btn-secondary">{{ __('Back to List') }}</a>
    </div>

    <form action="{{ route('admin_offer_store') }}" method="POST">
        @csrf

        <!-- Остальные поля -->

        <div class="form-group">
            <label for="skills">{{ __('Skills') }}</label>
            <select multiple class="form-control" id="skills" name="skills[]">
                @foreach($skills as $skill)
                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>
</div>
@endsection
