<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\VolunteerController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\TenderController;
use App\Http\Controllers\Admin\TenderProposalController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin_panel');

    Route::get('/volunteers_list', [VolunteerController::class, 'list'])->name('admin_volunteers_list');
    Route::get('/volunteers_create', [VolunteerController::class, 'create'])->name('admin_volunteer_create');
    Route::get('/volunteers_edit/{id}', [VolunteerController::class, 'edit'])->name('admin_volunteer_edit');
    Route::post('/volunteers_store', [VolunteerController::class, 'store'])->name('admin_volunteer_store');
    Route::put('/volunteers_update/{id}', [VolunteerController::class, 'update'])->name('admin_volunteer_update');
    Route::post('/volunteers_destroy', [VolunteerController::class, 'destroy'])->name('admin_volunteer_destroy');
    Route::get('/volunteers_show/{id}', [VolunteerController::class, 'show'])->name('admin_volunteer_show');

    Route::get('/reports', [ReportController::class, 'index'])->name('admin_reports_list');
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

    Route::get('/offers', [OfferController::class, 'index'])->name('admin_offers_index');
    Route::get('/offers/create', [OfferController::class, 'create'])->name('admin_offer_create');
    Route::post('/offers', [OfferController::class, 'store'])->name('admin_offer_store');
    Route::get('/offers/{id}', [OfferController::class, 'show'])->name('admin_offer_show');
    Route::get('/offers/{id}/edit', [OfferController::class, 'edit'])->name('admin_offer_edit');
    Route::put('/offers/{id}', [OfferController::class, 'update'])->name('admin_offer_update');
    Route::delete('/admin/offers/{id}', [OfferController::class, 'destroy'])->name('admin_offer_destroy');

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
});

require __DIR__ . '/auth.php';
