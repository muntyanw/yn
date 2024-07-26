@extends('layouts.admin_layout')

@section('title', __('List'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ __('Volunteers') }} {{ __('List') }}</h2>
            <a href="{{ route('admin_volunteer_create') }}" class="btn btn-primary">{{ __('Create') }}</a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ __('Photo') }}</th>
                    <th>{{ __('First Name') }}</th>
                    <th>{{ __('Middle Name') }}</th>
                    <th>{{ __('Last Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($volunteers as $volunteer)
                    <tr>
                        <td>
                            @if($volunteer->photo)
                                <img src="{{ asset('storage/' . $volunteer->photo) }}" alt="{{ $volunteer->first_name }}'s Photo" class="img-thumbnail" width="100">
                            @else
                                <img src="{{ asset('images/default-avatar.png') }}" alt="Default Photo" class="img-thumbnail" width="100">
                            @endif
                        </td>
                        <td>{{ $volunteer->first_name }}</td>
                        <td>{{ $volunteer->middle_name }}</td>
                        <td>{{ $volunteer->last_name }}</td>
                        <td>{{ $volunteer->email }}</td>
                        <td>{{ $volunteer->phone }}</td>
                        <td>
                            <a href="{{ route('admin_volunteer_show', ['id' => $volunteer->id]) }}" class="btn btn-info btn-sm">{{ __('View Details') }}</a>
                            <a href="{{ route('admin_volunteer_edit', ['id' => $volunteer->id]) }}" class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                            <form action="{{ route('admin_volunteer_destroy', ['id' => $volunteer->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('Are you sure you want to delete this volunteer?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">{{ __('No volunteers found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Пагинация -->
        <div class="d-flex justify-content-center mt-4">
            {{ $volunteers->links() }}
        </div>
    </div>
@endsection
