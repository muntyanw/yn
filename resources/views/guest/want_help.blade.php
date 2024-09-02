@extends('layouts.guest')

@section('title', __('Contact Us'))

@section('style')
    <style>
        .header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/storage/news_photos/k2rNcgk64YDy06dAdXB4LN3nbv7mLeTg0T5TjUWL.jpg') center/cover no-repeat;
        }

        .contact-form {
            padding: 2em;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-form input,
        .contact-form textarea {
            margin-bottom: 1em;
            width: 100%;
        }

        .contact-form button {
            margin-top: 1em;
        }
    </style>
@endsection

@section('content')
    <section class="content-section" style="min-height: 60em; margin-top: 2em;">
        <div class="container mt-5">
            <h3 class="text-center mb-4">{{ __('Contact Us') }}</h3>
            <div class="contact-form">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('guest_volunteer_want_help_send') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                            required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                            required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">{{ __('Phone') }}</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">{{ __('Note') }}</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required>@if (session('offer_id')){{ trim(__('Offer') . ' ' . session('offer_id')) }}@endif
                            {{ old('message') }}
                        </textarea>
                        @error('message')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection
