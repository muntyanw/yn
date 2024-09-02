@extends('layouts.admin_layout')

@section('title', __('Admin panel'))

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">{{ __('Admin panel') }}</h2>

        <div class="row">
            <!-- All Users -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('admin_users_index') }}"
                    class="btn btn-outline-primary w-100 p-3 d-flex align-items-center justify-content-center flex-column h-100">
                    <i class="fas fa-user-alt fa-2x mb-3"></i>
                    <div class="text-center">
                        <h5>{{ __('All Users') }}</h5>
                        <p>{{ __('Manage all users') }}</p>
                    </div>
                </a>
            </div>

            <!-- Volunteers -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('admin_volunteers_index') }}"
                    class="btn btn-outline-primary w-100 p-3 d-flex align-items-center justify-content-center flex-column h-100">
                    <i class="nav-icon far fa-grin-stars fa-2x mb-3"></i>
                    <div class="text-center">
                        <h5>{{ __('Volunteers') }}</h5>
                        <p>{{ __('Manage volunteers') }}</p>
                    </div>
                </a>
            </div>

            <!-- Reports -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('admin_report_list') }}"
                    class="btn btn-outline-primary w-100 p-3 d-flex align-items-center justify-content-center flex-column h-100">
                    <i class="fab fa-readme fa-2x mb-3"></i>
                    <div class="text-center">
                        <h5>{{ __('Reports') }}</h5>
                        <p>{{ __('Manage reports') }}</p>
                    </div>
                </a>
            </div>

             <!-- Financial Statements -->
             <div class="col-md-3 mb-4">
                <a href="{{ route('admin_financial_reports_index') }}"
                    class="btn btn-outline-primary w-100 p-3 d-flex align-items-center justify-content-center flex-column h-100">
                    <i class="fas fa-cash-register fa-2x mb-3"></i>
                    <div class="text-center">
                        <h5>{{ __('Financial statements') }}</h5>
                        <p>{{ __('Manage financial statements') }}</p>
                    </div>
                </a>
            </div>

            <!-- Skills -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('admin_skills_list') }}"
                    class="btn btn-outline-primary w-100 p-3 d-flex align-items-center justify-content-center flex-column h-100">
                    <i class="fas fa-tools fa-2x mb-3"></i>
                    <div class="text-center">
                        <h5>{{ __('Skills') }}</h5>
                        <p>{{ __('Manage skills') }}</p>
                    </div>
                </a>
            </div>

            <!-- Offers -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('admin_offers_index') }}"
                    class="btn btn-outline-primary w-100 p-3 d-flex align-items-center justify-content-center flex-column h-100">
                    <i class="fas fa-bullhorn fa-2x mb-3"></i>
                    <div class="text-center">
                        <h5>{{ __('Offers') }}</h5>
                        <p>{{ __('Manage offers') }}</p>
                    </div>
                </a>
            </div>

            <!-- Tenders -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('admin_tender_index') }}"
                    class="btn btn-outline-primary w-100 p-3 d-flex align-items-center justify-content-center flex-column h-100">
                    <i class="fas fa-award fa-2x mb-3"></i>
                    <div class="text-center">
                        <h5>{{ __('Tenders') }}</h5>
                        <p>{{ __('Manage tenders') }}</p>
                    </div>
                </a>
            </div>

            <!-- Tender Proposals -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('admin_tender_proposals_index') }}"
                    class="btn btn-outline-primary w-100 p-3 d-flex align-items-center justify-content-center flex-column h-100">
                    <i class="fas fa-bahai fa-2x mb-3"></i>
                    <div class="text-center">
                        <h5>{{ __('Tender Proposal') }}</h5>
                        <p>{{ __('Manage tender proposals') }}</p>
                    </div>
                </a>
            </div>

            <!-- News -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('admin.news.index') }}"
                    class="btn btn-outline-primary w-100 p-3 d-flex align-items-center justify-content-center flex-column h-100">
                    <i class="far fa-newspaper fa-2x mb-3"></i>
                    <div class="text-center">
                        <h5>{{ __('News') }}</h5>
                        <p>{{ __('Manage news') }}</p>
                    </div>
                </a>
            </div>

            <!-- Storage Files -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('admin_storage_files_index') }}"
                    class="btn btn-outline-primary w-100 p-3 d-flex align-items-center justify-content-center flex-column h-100">
                    <i class="far fa-file fa-2x mb-3"></i>
                    <div class="text-center">
                        <h5>{{ __('Storage Files') }}</h5>
                        <p>{{ __('Manage storage files') }}</p>
                    </div>
                </a>
            </div>

             <!-- Adds -->
             <div class="col-md-3 mb-4">
                <a href="{{ route('adds_pages_index') }}"
                    class="btn btn-outline-primary w-100 p-3 d-flex align-items-center justify-content-center flex-column h-100">
                    <i class="fab fa-adn fa-2x mb-3"></i>
                    <div class="text-center">
                        <h5>{{ __('Add to pages') }}</h5>
                        <p>{{ __('Manage storage files') }}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
