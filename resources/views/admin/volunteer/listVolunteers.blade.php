@extends('layouts.admin_layout')

@section('title', __('Volunteers'))

@section('content')
<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('Volunteers') }}</h2>
        <a href="{{ route('admin_users_index') }}" class="btn btn-primary">{{ __('Add New Volunteer') }}</a>
    </div>

    @if($volunteers->isEmpty())
        <p>{{ __('No volunteers found') }}</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('Photo') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Skills') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($volunteers as $volunteer)
                    <tr>
                        <td>
                            @if($volunteer->photo)
                                <img src="{{ asset('storage/' . $volunteer->photo) }}" alt="{{ $volunteer->first_name }}" style="width: 50px; height: 50px;">
                            @else
                                {{ __('No Photo') }}
                            @endif
                        </td>
                        <td>{{ $volunteer->first_name }} {{ $volunteer->last_name }}</td>
                        <td>{{ $volunteer->phone }}</td>
                        <td>{{ $volunteer->email }}</td>
                        <td>{{ $volunteer->skills->pluck('name')->implode(', ') }}</td>
                        <td>
                            <a href="{{ route('admin_volunteer_show', $volunteer->id) }}" class="btn btn-info">{{ __('Show') }}</a>
                            <a href="{{ route('admin_volunteer_edit', $volunteer->id) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                            <form action="{{ route('admin_volunteer_destroy', $volunteer->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete this volunteer?') }}')">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $volunteers->links() }} <!-- Пагинация -->
    @endif
</div>
@endsection
