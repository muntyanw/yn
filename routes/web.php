<?php

use Illuminate\Http\Request;
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
use App\Http\Controllers\Admin\FinancialReportController;
use App\Http\Controllers\Guest\GuestFinancialReportController;
use App\Http\Controllers\Admin\AddsPageController;
use App\Http\Middleware\AddAdditionsToView;

Route::middleware([AddAdditionsToView::class])->group(function () {
    Route::get('/', [GuestController::class, 'home'])->name('guest_home');
    Route::get('/aboutus', [GuestController::class, 'aboutUs'])->name('guest_aboutus');

    Route::get('/team', [TeamController::class, 'index'])->name('guest_team');
    Route::get('/volunteers/fetch', [TeamController::class, 'fetchTeam'])->name('guest_teem_fetch');
    Route::get('/employee/{id}', [TeamController::class, 'showEmployee'])->name('guest_emploee_show');
    Route::get('/volunteers/{id}', [TeamController::class, 'showVolunteer'])->name('guest_volunteer_show');

    Route::get('/volunteer-want-become', [GuestVolunteerController::class, 'wantBecome'])->name('guest_want_become_volunteer');
    Route::post('/volunteers/contact', [GuestVolunteerController::class, 'sendEmail'])->name('guest_volunteer_want_help_send');
    Route::get('/volunteer/offers', [GuestVolunteerController::class, 'index'])->name('guest_offers_index');
    Route::get('/volunteer/help/{offer_id}', [GuestVolunteerController::class, 'volunteerHelp'])->name('guest_volunteer_help');

    Route::get('/want-help', function () {
        return view('guest.want_help');
    })->name('guest_volunteer_want_help_form');

    Route::get('/news', [GuestNewsController::class, 'showNews'])->name('guest_news_index');
    Route::get('/news-list', [GuestNewsController::class, 'list'])->name('guest_news_list');
    Route::get('/news/fetch/{offset}', [GuestNewsController::class, 'fetchNews'])->name('guest_news_fetch');
    Route::get('/news/{id}', [GuestNewsController::class, 'show'])->name('guest_news_show');

    Route::prefix('reports')->name('guest_reports_')->group(function () {
        Route::get('/last', [GuestReportController::class, 'last'])->name('last');
        Route::get('/{year}', [GuestReportController::class, 'showYear'])->name('year');
        Route::get('/{year}/{month}', [GuestReportController::class, 'showMonth'])->name('month');
    });

    Route::prefix('financial_reports')->name('guest_financial_reports_')->group(function () {
        Route::get('/last', [GuestFinancialReportController::class, 'last'])->name('last');
        Route::get('/{year}', [GuestFinancialReportController::class, 'show'])->name('show');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/file/delete/{id}', [ProfileController::class, 'deleteFile'])->name('profile_delete_file');

    Route::get('/cabinet/volunteer/offers', [OfferVolunteerController::class, 'index'])->name('offer_volunteer_index');
    Route::get('/cabinet/volunteer/help/{offer_id}', [OfferVolunteerController::class, 'volunteerHelp'])->name('offer_volunteer_help');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin_panel')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin_panel');

    Route::get('/volunteers_index', [VolunteerController::class, 'index'])->name('admin_volunteers_index');
    Route::get('/volunteers/fetch/{offset}', [VolunteerController::class, 'fetchVolunteers'])->name('admin_volunteers_fetch');
    Route::get('/volunteers_create/{user_id}', [VolunteerController::class, 'create'])->name('admin_volunteer_create');
    Route::get('/volunteers_edit/{id}', [VolunteerController::class, 'edit'])->name('admin_volunteer_edit');
    Route::post('/volunteers_store', [VolunteerController::class, 'store'])->name('admin_volunteer_store');
    Route::put('/volunteers_update/{id}', [VolunteerController::class, 'update'])->name('admin_volunteer_update');
    Route::post('/volunteers_destroy', [VolunteerController::class, 'destroy'])->name('admin_volunteer_destroy');
    Route::get('/volunteers_show/{id}', [VolunteerController::class, 'show'])->name('admin_volunteer_show');
    Route::get('volunteer/file/download/{id}', [VolunteerController::class, 'downloadFile'])->name('admin_volunteer_download_file');
    Route::get('volunteer/file/download-path/{id}', [VolunteerController::class, 'downloadFilePath'])->name('admin_volunteer_download_file_path');
    Route::delete('volunteer/file/delete/{id}', [VolunteerController::class, 'deleteFile'])->name('admin_volunteer_delete_file');


    Route::get('/reports', [ReportController::class, 'index'])->name('admin_report_list');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('admin_report_create');
    Route::get('/reports/{id}/edit', [ReportController::class, 'edit'])->name('admin_report_edit');
    Route::post('/reports/save/{id?}', [ReportController::class, 'update'])->name('admin_report_save');
    Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('admin_report_destroy');
    Route::get('/reports/{id}', [ReportController::class, 'show'])->name('admin_report_show');
    Route::delete('/reports/{reportId}/photo-remove/{photoId}', [ReportController::class, 'deletePhoto'])->name('admin_report_delete_photo');
    Route::delete('/reports/{report}/file-remove/{file}', [ReportController::class, 'removeFile'])->name('admin_report_delete_file');
    Route::post('/reports/upload-photo', [ReportController::class, 'uploadPhoto'])->name('admin_report_upload_photo');



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
        Route::post('/delete', [TenderProposalController::class, 'destroy'])->name('destroy');
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

    Route::post('/storage/files/upload', [StorageController::class, 'upload'])->name('admin_storage_files_upload');
    Route::get('/storage/files', [StorageController::class, 'index'])->name('admin_storage_files_index');
    Route::post('/storage/images/upload', [StorageController::class, 'upload_images'])->name('admin_storage_images_upload');
    Route::delete('/storage/files/delete', [StorageController::class, 'delete'])->name('admin_storage_files_delete');
    Route::post('/storage/download-images', [StorageController::class, 'downloadImages'])->name('admin_storage_download_images');

    Route::get('/news', [NewsController::class, 'index'])->name('admin.news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/news/{news}', [NewsController::class, 'show'])->name('admin.news.show');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('admin.news.destroy');

    Route::post('/financial-reports-delete-file', [FinancialReportController::class, 'deleteFile'])->name('admin_financial_reports_delete-file');
    Route::get('/financial-reports', [FinancialReportController::class, 'index'])->name('admin_financial_reports_index');
    Route::get('/financial-reports/create', [FinancialReportController::class, 'create'])->name('admin_financial_reports_create');
    Route::get('/financial-reports/edit/{id}', [FinancialReportController::class, 'edit'])->name('admin_financial_reports_edit');
    Route::post('/financial-reports/store-or-update/{id?}', [FinancialReportController::class, 'storeOrUpdate'])->name('admin_financial_reports_storeOrUpdate');
    Route::get('/financial-reports/show/{year}', [FinancialReportController::class, 'show'])->name('admin_financial_reports_show');
    Route::delete('/financial-reports-delete/{id}', [FinancialReportController::class, 'destroy'])->name('admin_financial_reports_destroy');

    Route::get('adds_pages', [AddsPageController::class, 'index'])->name('adds_pages_index');
    Route::get('adds_pages/create_or_edit/{addsPage?}', [AddsPageController::class, 'createOrEdit'])->name('adds_pages_create_or_edit');
    Route::post('adds_pages/save/{addsPage?}', [AddsPageController::class, 'save'])->name('adds_pages_save');
    Route::delete('adds_pages/destroy/{id}', [AddsPageController::class, 'destroy'])->name('adds_pages_delete');
});

require __DIR__ . '/auth.php';
