<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreateReport;
use App\Http\Controllers\CreateGuest;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/view_rooms', function () {
        return view('user.view-rooms');
    })->name('view_rooms');
    Route::get('/reserve_room', function () {
        return view('user.reserve-room');
    })->name('reserve_room');
    Route::get('/my_room', function () {
        return view('user.my-room');
    })->name('my_room');
    Route::get('/report', function () {
        return view('user.report');
    })->name('report');
    Route::post('/create-report', [CreateReport::class, 'create'])->name('create-report');
    Route::get('/guest_form', function () {
        return view('user.guest-form');
    })->name('guest-form');
    Route::post('/create-guest', [CreateGuest::class, 'create'])->name('create-guest');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin-dashboard');
    })->name('admin.dashboard');
});


Route::get('/home', [AdminController::class, 'index'])->name('home');
Route::get('/admin/profile', [AdminController::class, 'adminShow'])->name('admin-show');

Route::get('/manage_rooms_pria', [AdminController::class, 'manage_rooms_pria'])->name('manage_rooms_pria');
Route::post('/admin/update_email_pria/{id}', [AdminController::class, 'updateEmailPria'])->name('admin.update_email_pria');

Route::get('/manage_rooms_perempuan', [AdminController::class, 'manage_rooms_perempuan'])->name('manage_rooms_perempuan');
Route::post('/admin/update_email_perempuan/{id}', [AdminController::class, 'updateEmailPerempuan'])->name('admin.update_email_perempuan');
