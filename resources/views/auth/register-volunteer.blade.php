@extends('layouts.guest')

@section('title', __('Register'))

@section('style')
    <style>
        .header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/storage/news_photos/k2rNcgk64YDy06dAdXB4LN3nbv7mLeTg0T5TjUWL.jpg') center/cover no-repeat;
            transition: background-color 0.3s ease;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="padding-top: 2em;">
        <div class="card p-4" style="width: 100%; max-width: 400px; margin-top: 5em; margin-bottom:1em;">
            <div class="text-center mb-4">
                <img src="/storage/common/oovpKJMyh4leT8NYjk3JRxd1g5MRMn7C3texDBqP.png" alt="logo" class="img-fluid"
                    style="max-width: 120px;">
            </div>

            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}"
                        required autocomplete="username">
                    @if ($errors->has('email'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <div class="input-group">
                        <input id="password" class="form-control" type="password" name="password" required
                            autocomplete="new-password">
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="togglePasswordVisibility('password')">
                            <i id="password-toggle-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="input-group">
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
                            required autocomplete="new-password">
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="togglePasswordVisibility('password_confirmation')">
                            <i id="password_confirmation-toggle-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>

                <!-- Дополнительные поля для волонтера -->
                <div class="mb-3">
                    <label for="first_name" class="form-label">{{ __('First Name') }}</label>
                    <input id="first_name" class="form-control" type="text" name="first_name"
                        value="{{ old('first_name') }}" required>
                    @if ($errors->has('first_name'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('first_name') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="middle_name" class="form-label">{{ __('Middle Name') }}</label>
                    <input id="middle_name" class="form-control" type="text" name="middle_name"
                        value="{{ old('middle_name') }}">
                    @if ($errors->has('middle_name'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('middle_name') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                    <input id="last_name" class="form-control" type="text" name="last_name"
                        value="{{ old('last_name') }}" required>
                    @if ($errors->has('last_name'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('last_name') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">{{ __('Photo') }}</label>
                    <input id="photo" class="form-control-file" type="file" name="photo" onchange="previewImage()">
                    @if ($errors->has('photo'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('photo') }}
                        </div>
                    @endif
                    <div id="photo-preview" class="mt-2">
                        <img id="photo-preview-img" src="#" alt="Photo Preview"
                            style="display:none; max-width: 100%; height: auto;">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('Phone') }}</label>
                    <input id="phone" class="form-control" type="text" name="phone"
                        value="{{ old('phone') }}" required>
                    @if ($errors->has('phone'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('Address') }}</label>
                    <textarea id="address" class="form-control" name="address" required>{{ old('address') }}</textarea>
                    @if ($errors->has('address'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="about_me" class="form-label">{{ __('About Me') }}</label>
                    <textarea id="about_me" class="form-control" name="about_me" rows="4">{{ old('about_me') }}</textarea>
                    @if ($errors->has('about_me'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('about_me') }}
                        </div>
                    @endif
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="public_access" name="public_access"
                        {{ old('public_access', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="public_access">{{ __('Public Access') }}</label>
                    @if ($errors->has('public_access'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('public_access') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="files">{{ __('Attach Files') }}</label>
                    <input type="file" class="form-control-file" id="files" name="files[]" multiple>
                    @if ($errors->has('files.*'))
                        <div class="text-danger mt-2">
                            {{ $errors->first('files.*') }}
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

        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = fieldId === 'password' ? document.getElementById('password-toggle-icon') : document.getElementById(
                'password_confirmation-toggle-icon');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
