<section class="mt-4">
    <header>
        <h2 class="text-lg font-medium text-dark">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-muted">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
            <input type="password" class="form-control" id="update_password_current_password" name="current_password" autocomplete="current-password">
            @if($errors->updatePassword->get('current_password'))
                <div class="text-danger mt-2">
                    {{ $errors->updatePassword->get('current_password')[0] }}
                </div>
            @endif
        </div>

        <!-- New Password -->
        <div class="mb-3">
            <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
            <input type="password" class="form-control" id="update_password_password" name="password" autocomplete="new-password">
            @if($errors->updatePassword->get('password'))
                <div class="text-danger mt-2">
                    {{ $errors->updatePassword->get('password')[0] }}
                </div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input type="password" class="form-control" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
            @if($errors->updatePassword->get('password_confirmation'))
                <div class="text-danger mt-2">
                    {{ $errors->updatePassword->get('password_confirmation')[0] }}
                </div>
            @endif
        </div>

        <!-- Save Button -->
        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-success mb-0" id="passwordUpdatedMessage">
                    {{ __('Saved.') }}
                </p>
                <script>
                    setTimeout(() => {
                        document.getElementById('passwordUpdatedMessage').style.display = 'none';
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
</section>
