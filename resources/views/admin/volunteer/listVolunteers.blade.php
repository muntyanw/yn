@extends('layouts.admin_layout')

@section('title', __('Volunteers'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>{{ __('Volunteers') }}</h2>
            <a href="{{ route('admin_users_index') }}" class="btn btn-primary">{{ __('Add New Volunteer') }}</a>
        </div>

        @if ($volunteers->isEmpty())
            <p>{{ __('No volunteers found') }}</p>
        @else
            <div class="table-responsive">
                <div class="d-flex bg-light font-weight-bold p-2">
                    <div class="p-2 flex-fill">{{ __('Photo') }}</div>
                    <div class="p-2 flex-fill">{{ __('Name') }}</div>
                    {{-- <div class="p-2 flex-fill">{{ __('Phone') }}</div> --}}
                    {{-- <div class="p-2 flex-fill">{{ __('Email') }}</div> --}}
                    <div class="p-2 flex-fill">{{ __('Skills') }}</div>
                    {{-- <div class="p-2 flex-fill">{{ __('About Me') }}</div> --}}
                    <div class="p-2 flex-fill">{{ __('Is Employee') }}</div>
                    <div class="p-2 flex-fill">{{ __('Public Info') }}</div>
                    <div class="p-2 flex-fill">{{ __('Actions') }}</div>
                </div>
                @foreach ($volunteers as $volunteer)
                    <div class="d-flex align-items-center border-bottom p-2">
                        <div class="p-2 flex-fill">
                            @if ($volunteer->photo)
                                <img src="{{ $volunteer->photo }}" alt="{{ $volunteer->first_name }}"
                                    class="img-fluid rounded" style="width: 50px; height: 50px;">
                            @else
                                {{ __('No Photo') }}
                            @endif
                        </div>
                        <div class="p-2 flex-fill">{{ $volunteer->first_name }} {{ $volunteer->last_name }}</div>
                        {{-- <div class="p-2 flex-fill">{{ $volunteer->phone }}</div>
                    <div class="p-2 flex-fill">{{ $volunteer->email }}</div> --}}
                        <div class="p-2 flex-fill">{{ $volunteer->skills->pluck('name')->implode(', ') }}</div>
                        {{-- <div class="p-2 flex-fill">{{ $volunteer->about_me }}</div>  --}}
                        <div class="p-2 flex-fill">{{ $volunteer->is_employee ? __('Yes') : __('No') }}</div>
                        <div class="p-2 flex-fill">{{ $volunteer->public_access ? __('Yes') : __('No') }}</div>
                        <div class="p-2 flex-fill d-flex flex-wrap">
                            <a href="{{ route('admin_volunteer_show', $volunteer->id) }}"
                                class="btn btn-info btn-sm mr-2">{{ __('Show') }}</a>
                            <a href="{{ route('admin_volunteer_edit', $volunteer->id) }}"
                                class="btn btn-warning btn-sm mr-2">{{ __('Edit') }}</a>
                            <form action="{{ route('admin_volunteer_destroy') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $volunteer->id }}">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('{{ __('Are you sure you want to delete this volunteer?') }}')">{{ __('Delete') }}</button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>

            {{ $volunteers->links() }} <!-- Пагинация -->
        @endif
    </div>
@endsection
