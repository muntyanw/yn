@extends('layouts.app')

@section('title', __('Profile edit'))

@section('style')

@endsection

@section('content')
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 space-y-4">
                    <!-- Update Profile Information Form -->
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('user.profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password Form -->
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('user.profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete User Form -->
                    <div class="card mb-4">
                        <div class="card-body">
                            @include('user.profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
