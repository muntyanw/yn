<!-- resources/views/admin/skills/index.blade.php -->
@extends('layouts.admin_layout')

@section('title', __('Skills'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ __('Skills') }}</h2>
            <a href="{{ route('admin_skill_create') }}" class="btn btn-primary">{{ __('Add New Skill') }}</a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skills as $skill)
                    <tr>
                        <td>{{ $skill->name }}</td>
                        <td>{{ Str::limit($skill->description, 50) }}</td>
                        <td>
                            <a href="{{ route('admin_skill_edit', ['skill' => $skill->id]) }}"
                                class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                            <form action="{{ route('admin_skill_destroy', ['skill' => $skill->id]) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('{{ __('Are you sure you want to delete this skill?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">{{ __('No skills found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Пагинация -->
        <div class="d-flex justify-content-center mt-4">
            {{ $skills->links() }}
        </div>
    </div>
@endsection
