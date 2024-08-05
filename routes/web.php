<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\TenderController;
use App\Http\Controllers\Admin\TenderProposalController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StorageController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Guest\GuestVolunteerController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Guest\GuestNewsController;
use App\Http\Controllers\Guest\TeamController;
use App\Http\Controllers\Volunteer\OfferVolunteerController;
use App\Http\Controllers\Guest\GuestReportController;

Route::get('/', [GuestController::class, 'home'])->name('guest_home');
Route::get('/aboutus', [GuestController::class, 'aboutUs'])->name('guest_aboutus');

Route::get('/team', [TeamController::class, 'index'])->name('guest_team');
Route::get('/volunteers/fetch', [TeamController::class, 'fetchVolunteers'])->name('guest_volunteers_fetch');
Route::get('/volunteers/{id}', [TeamController::class, 'show'])->name('guest_volunteer_show');

Route::get('/volunteer-want-become', [GuestVolunteerController::class, 'wantBecome'])->name('guest_want_become_volunteer');
Route::get('/volunteers/want-help', [GuestVolunteerController::class, 'showForm'])->name('guest_volunteer_want_help_form');
Route::post('/volunteers/contact', [GuestVolunteerController::class, 'sendEmail'])->name('guest_volunteer_want_help_send');
Route::get('/volunteer/offers', [GuestVolunteerController::class, 'index'])->name('guest_offers_index');
Route::get('/volunteer/help/{offer_id}', [GuestVolunteerController::class, 'volunteerHelp'])->name('guest_volunteer_help');

Route::get('/news', [GuestNewsController::class, 'showNews'])->name('guest_news_index');
Route::get('/news-list', [GuestNewsController::class, 'list'])->name('guest_news_list');
Route::get('/news/fetch/{offset}', [GuestNewsController::class, 'fetchNews'])->name('guest_news_fetch');
Route::get('/news/{id}', [GuestNewsController::class, 'show'])->name('guest_news_show');

// Группируем маршруты под одним префиксом и пространством имен
Route::prefix('reports')->name('guest_reports_')->group(function () {
    Route::get('/months/{year}', [GuestReportController::class, 'getMonths'])->name('months');
    Route::get('/', [GuestReportController::class, 'index'])->name('index');
    Route::get('{year}', [GuestReportController::class, 'showYear'])->name('showYear');
    Route::get('{year}/{month}', [GuestReportController::class, 'showMonth'])->name('showMonth');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/cabinet/volunteer/offers', [OfferVolunteerController::class, 'index'])->name('offer_volunteer_index');
    Route::get('/cabinet/volunteer/help/{offer_id}', [OfferVolunteerController::class, 'volunteerHelp'])->name('offer_volunteer_help');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin_panel')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin_panel');

    Route::get('/volunteers_index', [VolunteerController::class, 'index'])->name('admin_volunteers_index');
    Route::get('/volunteers_create/{user_id}', [VolunteerController::class, 'create'])->name('admin_volunteer_create');
    Route::get('/volunteers_edit/{id}', [VolunteerController::class, 'edit'])->name('admin_volunteer_edit');
    Route::post('/volunteers_store', [VolunteerController::class, 'store'])->name('admin_volunteer_store');
    Route::put('/volunteers_update/{id}', [VolunteerController::class, 'update'])->name('admin_volunteer_update');
    Route::post('/volunteers_destroy', [VolunteerController::class, 'destroy'])->name('admin_volunteer_destroy');
    Route::get('/volunteers_show/{id}', [VolunteerController::class, 'show'])->name('admin_volunteer_show');

    Route::get('/reports', [ReportController::class, 'index'])->name('admin_reports_index');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('admin_report_create');
    Route::post('/reports', [ReportController::class, 'store'])->name('admin_report_store');
    Route::get('/reports/{id}/edit', [ReportController::class, 'edit'])->name('admin_report_edit');
    Route::put('/reports/{id}', [ReportController::class, 'update'])->name('admin_report_update');
    Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('admin_report_destroy');
    Route::get('/reports/{id}', [ReportController::class, 'show'])->name('admin_report_show');

    Route::get('skills', [SkillController::class, 'index'])->name('admin_skills_list');
    Route::get('skills/create', [SkillController::class, 'create'])->name('admin_skill_create');
    Route::post('skills', [SkillController::class, 'store'])->name('admin_skill_store');
    Route::get('skills/{skill}/edit', [SkillController::class, 'edit'])->name('admin_skill_edit');
    Route::put('skills/{skill}', [SkillController::class, 'update'])->name('admin_skill_update');
    Route::delete('skills/{skill}', [SkillController::class, 'destroy'])->name('admin_skill_destroy');


    Route::name('admin_')->group(function () {
        Route::get('offers', [OfferController::class, 'index'])->name('offers_index');
        Route::get('offers/create', [OfferController::class, 'create'])->name('offer_create');
        Route::post('offers', [OfferController::class, 'store'])->name('offer_store');
        Route::get('offers/{id}', [OfferController::class, 'show'])->name('offer_show');
        Route::get('offers/{id}/edit', [OfferController::class, 'edit'])->name('offer_edit');
        Route::put('offers/{id}', [OfferController::class, 'update'])->name('offer_update');
        Route::delete('offers/{id}', [OfferController::class, 'destroy'])->name('offer_destroy');
    });


    Route::prefix('tenders')->group(function () {
        Route::get('/', [TenderController::class, 'index'])->name('admin_tender_index');
        Route::get('/create', [TenderController::class, 'create'])->name('admin_tender_create');
        Route::post('/', [TenderController::class, 'store'])->name('admin_tender_store');
        Route::get('/{id}', [TenderController::class, 'show'])->name('admin_tender_show');
        Route::get('/{id}/edit', [TenderController::class, 'edit'])->name('admin_tender_edit');
        Route::put('/{id}', [TenderController::class, 'update'])->name('admin_tender_update');
        Route::delete('/{id}', [TenderController::class, 'destroy'])->name('admin_tender_destroy');
    });

    // Тендерные предложения
    Route::prefix('/tender-proposals')->name('admin_tender_proposals_')->group(function () {
        Route::get('/', [TenderProposalController::class, 'index'])->name('index');
        Route::get('create/{tenderId}', [TenderProposalController::class, 'create'])->name('create');
        Route::post('store', [TenderProposalController::class, 'store'])->name('store');
        Route::get('{id}/edit', [TenderProposalController::class, 'edit'])->name('edit');
        Route::put('{id}', [TenderProposalController::class, 'update'])->name('update');
        Route::delete('{id}', [TenderProposalController::class, 'destroy'])->name('destroy');
        Route::get('{id}', [TenderProposalController::class, 'show'])->name('show');
    });

    Route::prefix('/users')->name('admin_users_')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('{id}', [UserController::class, 'show'])->name('show');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('{id}', [UserController::class, 'update'])->name('update');
        Route::post('delete', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::get('/storage/files', [StorageController::class, 'index'])->name('admin_storage_files_index');
    Route::post('/storage/files/upload', [StorageController::class, 'upload'])->name('admin_storage_files_upload');
    Route::delete('/storage/files/delete', [StorageController::class, 'delete'])->name('admin_storage_files_delete');
    Route::post('/storage/download-images', [StorageController::class, 'downloadImages'])->name('admin_storage_download_images');

    Route::get('/news', [NewsController::class, 'index'])->name('admin.news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/news/{news}', [NewsController::class, 'show'])->name('admin.news.show');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('admin.news.destroy');
});

require __DIR__ . '/auth.php';
