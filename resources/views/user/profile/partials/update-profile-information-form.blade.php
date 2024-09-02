<section class="mt-4">
    <header>
        <h2 class="text-lg font-medium text-dark">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-muted">
            {{ __('Update your account s profile information and email address.') }}
        </p>
    </header>

    <!-- Form for Resending Verification Email -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Profile Update Form -->
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-4">
        @csrf
        @method('patch')

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @if ($errors->get('name'))
                <div class="text-danger mt-2">
                    {{ $errors->get('name')[0] }}
                </div>
            @endif
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            @if ($errors->get('email'))
                <div class="text-danger mt-2">
                    {{ $errors->get('email')[0] }}
                </div>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-link p-0" style="text-decoration: underline;">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- First Name -->
        <div class="mb-3">
            <label for="first_name" class="form-label">{{ __('First Name') }}</label>
            <input type="text" class="form-control" id="first_name" name="first_name"
                value="{{ old('first_name', $volunteer->first_name) }}" required>
            @if ($errors->get('first_name'))
                <div class="text-danger mt-2">
                    {{ $errors->get('first_name')[0] }}
                </div>
            @endif
        </div>

        <!-- Middle Name -->
        <div class="mb-3">
            <label for="middle_name" class="form-label">{{ __('Middle Name') }}</label>
            <input type="text" class="form-control" id="middle_name" name="middle_name"
                value="{{ old('middle_name', $volunteer->middle_name) }}">
            @if ($errors->get('middle_name'))
                <div class="text-danger mt-2">
                    {{ $errors->get('middle_name')[0] }}
                </div>
            @endif
        </div>

        <!-- Last Name -->
        <div class="mb-3">
            <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
            <input type="text" class="form-control" id="last_name" name="last_name"
                value="{{ old('last_name', $volunteer->last_name) }}" required>
            @if ($errors->get('last_name'))
                <div class="text-danger mt-2">
                    {{ $errors->get('last_name')[0] }}
                </div>
            @endif
        </div>

        <!-- Phone -->
        <div class="mb-3">
            <label for="phone" class="form-label">{{ __('Phone') }}</label>
            <input type="text" class="form-control" id="phone" name="phone"
                value="{{ old('phone', $volunteer->phone) }}" required>
            @if ($errors->get('phone'))
                <div class="text-danger mt-2">
                    {{ $errors->get('phone')[0] }}
                </div>
            @endif
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label for="address" class="form-label">{{ __('Address') }}</label>
            <textarea class="form-control" id="address" name="address" required>{{ old('address', $volunteer->address) }}</textarea>
            @if ($errors->get('address'))
                <div class="text-danger mt-2">
                    {{ $errors->get('address')[0] }}
                </div>
            @endif
        </div>

        <!-- About Me -->
        <div class="mb-3">
            <label for="about_me" class="form-label">{{ __('About Me') }}</label>
            <textarea class="form-control" id="about_me" name="about_me" rows="4">{{ old('about_me', $volunteer->about_me) }}</textarea>
            @if ($errors->get('about_me'))
                <div class="text-danger mt-2">
                    {{ $errors->get('about_me')[0] }}
                </div>
            @endif
        </div>

        <!-- Photo -->
        <div class="mb-3">
            <label for="photo" class="form-label">{{ __('Photo') }}</label>

            <!-- Отображение существующего фото -->
            @if ($volunteer->photo)
                <div class="mb-2">
                    <img src="{{ $volunteer->photo }}" alt="{{ __('Current Photo') }}"
                        class="img-thumbnail" style="max-width: 150px;">
                </div>
            @endif

            <input type="file" class="form-control-file" id="photo" name="photo">
            @if ($errors->get('photo'))
                <div class="text-danger mt-2">
                    {{ $errors->get('photo')[0] }}
                </div>
            @endif
        </div>


        <!-- Is Employee -->
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="is_employee" name="is_employee"
                {{ old('is_employee', $volunteer->is_employee) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_employee">{{ __('Is Employee') }}</label>
            @if ($errors->get('is_employee'))
                <div class="text-danger mt-2">
                    {{ $errors->get('is_employee')[0] }}
                </div>
            @endif
        </div>

        <!-- Public Access -->
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="public_access" name="public_access"
                {{ old('public_access', $volunteer->public_access) ? 'checked' : '' }}>
            <label class="form-check-label" for="public_access">{{ __('Public Access') }}</label>
            @if ($errors->get('public_access'))
                <div class="text-danger mt-2">
                    {{ $errors->get('public_access')[0] }}
                </div>
            @endif
        </div>

        <!-- Attached Files -->
        <div class="card mt-4">
            <div class="card-header">
                {{ __('Attached Files') }}
            </div>
            <div class="card-body">
                @if ($volunteer->files->isEmpty())
                    <p>{{ __('No files attached.') }}</p>
                @else
                    <ul class="list-group">
                        @foreach ($volunteer->files as $file)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                    {{ $file->file_name }}
                                </a>
                                <div class="btn-group" role="group">
                                    <!-- Кнопка для скачивания -->
                                    <a href="{{ route('admin_volunteer_download_file', $file->id) }}"
                                        class="btn btn-sm btn-primary">
                                        {{ __('Download') }}
                                    </a>

                                    <!-- Кнопка для удаления -->
                                    <button type="button" class="btn btn-sm btn-danger delete-file-btn"
                                        data-file-id="{{ $file->id }}">
                                        {{ __('Delete') }}
                                    </button>

                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- Attach New Files -->
        <div class="form-group mt-4">
            <label for="files">{{ __('Attach New Files') }}</label>
            <input type="file" class="form-control-file" id="files" name="files[]" multiple>
            @if ($errors->get('files.*'))
                <div class="text-danger mt-2">
                    {{ $errors->get('files.*')[0] }}
                </div>
            @endif
        </div>

        <!-- Save Button -->
        <div class="d-flex align-items-center gap-4 mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-success mb-0" id="profileUpdatedMessage">
                    {{ __('Saved.') }}
                </p>
                <script>
                    setTimeout(() => {
                        document.getElementById('profileUpdatedMessage').style.display = 'none';
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
</section>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.delete-file-btn').click(function() {
                var fileId = $(this).data('file-id');
                var url = '{{ route('profile_delete_file', ':id') }}';
                url = url.replace(':id', fileId);

                if (confirm('{{ __('Are you sure you want to delete this file?') }}')) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert(response.message);
                            location.reload(); // Обновляем страницу после успешного удаления
                        },
                        error: function(xhr) {
                            alert('{{ __('An error occurred while deleting the file.') }}');
                        }
                    });
                }
            });
        });
    </script>
@endsection
