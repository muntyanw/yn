<!-- resources/views/admin/offers/index.blade.php -->
@extends('layouts.admin_layout')

@section('title', __('Offers'))

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ __('Offers') }}</h2>
            <a href="{{ route('admin_offer_create') }}" class="btn btn-primary">{{ __('Add New Offer') }}</a>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Skills Type') }}</th>
                    <th>{{ __('Vacancies') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($offers as $offer)
                    <tr>
                        <td>
                            @if ($offer->image)
                                <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ __('Image') }}"
                                    class="img-thumbnail" width="100">
                            @else
                                <span>{{ __('No Image') }}</span>
                            @endif
                        </td>
                        <td>{{ $offer->title }}</td>
                        <td>{{ $offer->skills_type }}</td>
                        <td>{{ $offer->vacancies }}</td>
                        <td>
                            <a href="{{ route('admin_offer_show', ['id' => $offer->id]) }}"
                                class="btn btn-info btn-sm">{{ __('View') }}</a>
                            <a href="{{ route('admin_offer_edit', ['id' => $offer->id]) }}"
                                class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                            <form action="{{ route('admin_offer_destroy', ['id' => $offer->id]) }}" method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('{{ __('Are you sure you want to delete this offer?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">{{ __('No offers found') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $offers->links() }}
        </div>
    </div>
@endsection
