@extends('layouts.guest')

@section('title', __('About Us'))

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
    <div class="card p-4" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <img src="/storage/common/j4IQVqbmHuTecqRnCYtxY32xTIUNZ3LuScf7jryL.png" alt="logo" class="img-fluid">
        </div>
        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @if ($errors->has('email'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
                @if ($errors->has('password'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                @if (Route::has('password.request'))
                    <a class="text-decoration-none text-secondary" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="btn btn-primary" style="margin-left: 4em;">
                    {{ __('Log in') }}
                </button>
                <a href="{{ route('register') }}" class="btn btn-primary {{ request()->is('dashboard') ? 'active' : '' }}">
                    Register
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
