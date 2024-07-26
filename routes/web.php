<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

    Route::get('/volunteers_list', [App\Http\Controllers\Admin\VolunteerController::class, 'list'])->name('admin_volunteers_list');
    Route::get('/volunteers_create', [App\Http\Controllers\Admin\VolunteerController::class, 'create'])->name('admin_volunteer_create');
    Route::get('/volunteers_edit/{id}', [App\Http\Controllers\Admin\VolunteerController::class, 'edit'])->name('admin_volunteer_edit');
    Route::post('/volunteers_store', [App\Http\Controllers\Admin\VolunteerController::class, 'store'])->name('admin_volunteer_store');
    Route::put('/volunteers_update/{id}', [App\Http\Controllers\Admin\VolunteerController::class, 'update'])->name('admin_volunteer_update');
    Route::post('/volunteers_destroy', [App\Http\Controllers\Admin\VolunteerController::class, 'destroy'])->name('admin_volunteer_destroy');
    Route::get('/volunteers_show/{id}', [App\Http\Controllers\Admin\VolunteerController::class, 'show'])->name('admin_volunteer_show');

});

require __DIR__ . '/auth.php';
