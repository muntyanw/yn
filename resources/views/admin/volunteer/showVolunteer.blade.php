@extends('layouts.admin_layout')

@section('title', __('View Volunteer'))

@section('content')
<div class="container mt-5 mb-5">
    <h2>{{ __('View Volunteer') }}</h2>

    <div class="card">
        <div class="card-header">
            {{ __('Volunteer Details') }}
        </div>
        <div class="card-body">
            <p><strong>{{ __('Full Name') }}:</strong> {{ $volunteer->first_name }} {{ $volunteer->middle_name }} {{ $volunteer->last_name }}</p>
            <p><strong>{{ __('Phone') }}:</strong> {{ $volunteer->phone }}</p>
            <p><strong>{{ __('Email') }}:</strong> {{ $volunteer->email }}</p>
            <p><strong>{{ __('Address') }}:</strong> {{ $volunteer->address }}</p>
            <p><strong>{{ __('Photo') }}:</strong> 
                @if($volunteer->photo)
                    <img src="{{ $volunteer->photo }}" alt="Photo" style="width: 100px;">
                @else
                    {{ __('No Photo') }}
                @endif
            </p>
            <p><strong>{{ __('Skills') }}:</strong> {{ $volunteer->skills->pluck('name')->implode(', ') }}</p>
            <p><strong>{{ __('About Me') }}:</strong> {{ $volunteer->about_me }}</p>
            <p><strong>{{ __('Is Employee') }}:</strong> {{ $volunteer->is_employee ? __('Yes') : __('No') }}</p>
            <p><strong>{{ __('Public Access') }}:</strong> {{ $volunteer->public_access ? __('Yes') : __('No') }}</p>
            <p><strong>{{ __('User') }}:</strong> <a href="{{ route('admin_users_show', $volunteer->user_id) }}">{{ $volunteer->user->name }}</a></p>

            <div class="card mt-4">
                <div class="card-header">
                    {{ __('Attached Files') }}
                </div>
                <div class="card-body">
                    @if($volunteer->files->isEmpty())
                        <p>{{ __('No files attached.') }}</p>
                    @else
                        <ul class="list-group">
                            @foreach($volunteer->files as $file)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                        {{ $file->file_name }}
                                    </a>
                                    <div class="btn-group" role="group">
                                        <!-- Кнопка для скачивания -->
                                        <a href="{{ route('admin_volunteer_download_file', $file->id) }}" class="btn btn-sm btn-primary">
                                            {{ __('Download') }}
                                        </a>
                                        <!-- Кнопка для удаления -->
                                        <form action="{{ route('admin_volunteer_delete_file', $file->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete this file?') }}')">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <a href="{{ route('admin_volunteers_index') }}" class="btn btn-secondary">{{ __('Back to Volunteers') }}</a>
        </div>
    </div>
</div>
@endsection
