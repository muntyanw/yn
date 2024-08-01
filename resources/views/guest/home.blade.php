@extends('layouts.guest')

@section('title', __('About Us'))

@section('content')

    @include('guest.partials.hero', ['isButton' => true])

    @include('guest.partials.news', ['news' => $news])

@endsection
