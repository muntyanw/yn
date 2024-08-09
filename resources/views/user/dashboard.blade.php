@extends('layouts.app')

@section('title', __('Dashboard'))

@section('style')
    
@endsection

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="text-center text-muted">
                                {{ __("You're logged in!") }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
