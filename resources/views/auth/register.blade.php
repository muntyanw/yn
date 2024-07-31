@extends('layouts.guest')

@section('title', __('Register'))

@section('style')
    <style>
         .header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/storage/common/BgusTKIorv14R5WHlfXUy5FZYKwEbkauxbHsxIAP.jpg') center/cover no-repeat;
            transition: background-color 0.3s ease;
        }
    </style>
@endsection

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 100%; max-width: 400px;margin-top: 5em;">
        <div class="text-center mb-4">
            <img src="/storage/common/j4IQVqbmHuTecqRnCYtxY32xTIUNZ3LuScf7jryL.png" alt="logo" class="img-fluid">
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @if ($errors->has('name'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @if ($errors->has('email'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                @if ($errors->has('password'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                @if ($errors->has('password_confirmation'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a class="text-decoration-none text-secondary" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
