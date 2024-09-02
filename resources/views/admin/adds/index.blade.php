@extends('layouts.admin_layout')

@section('title', __('List Adds'))

@section('content')
    <h1>{{ __('List of Adds') }}</h1>

    <a href="{{ route('adds_pages_create_or_edit') }}" class="btn btn-primary mb-3">{{ __('Create Add') }}</a>

    @if ($addsPages->isEmpty())
        <p>{{ __('No Adds available.') }}</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Enabled') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($addsPages as $addsPage)
                    <tr>
                        <td>{{ $addsPage->id }}</td>
                        <td>{{ $addsPage->description }}</td>
                        <td>{{ $addsPage->enabled ? __('Yes') : __('No') }}</td>
                        <td>
                            <a href="{{ route('adds_pages_create_or_edit', $addsPage->id) }}"
                                class="btn btn-warning">{{ __('Edit') }}</a>
                            <form action="{{ route('adds_pages_delete', ['id' => $addsPage->id]) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('{{ __('Are you sure you want to delete this Add?') }}')">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
