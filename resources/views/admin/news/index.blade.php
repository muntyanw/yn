@extends('layouts.admin_layout')

@section('title', __('News'))

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ __('Новини') }}</h2>
            <a href="{{ route('admin.news.create') }}" class="btn btn-primary">{{ __('Додати новину') }}</a>
        </div>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>{{ __('Дата') }}</th>
                    <th>{{ __('Час') }}</th>
                    <th>{{ __('Заголовок') }}</th>
                    <th>{{ __('Фото') }}</th>
                    <th>{{ __('Дії') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                    <tr>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->time }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            @if ($item->photo)
                                <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->title }}" style="max-width: 100px;" class="img-fluid">
                            @else
                                {{ __('Немає фото') }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.news.show', $item->id) }}" class="btn btn-info btn-sm">{{ __('Переглянути') }}</a>
                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-warning btn-sm">{{ __('Редагувати') }}</a>
                            <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('Ви впевнені, що хочете видалити цю новину?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Видалити') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
