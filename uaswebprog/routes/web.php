<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreateReport;
use App\Http\Controllers\CreateGuest;
use App\Http\Controllers\CreateReservation;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
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
    Route::post('/create_reservation', [CreateReservation::class, 'create'])->name('create-reservation');
    Route::get('/my_room', function () {
        return view('user.my-room');
    })->name('my_room');
    Route::get('/report', function () {
        return view('user.report');
    })->name('report');
    Route::post('/create_report', [CreateReport::class, 'create'])->name('create-report');
    Route::get('/guest_form', function () {
        return view('user.guest-form');
    })->name('guest-form');
    Route::post('/create_guest', [CreateGuest::class, 'create'])->name('create-guest');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/admin/guests/{id}', [AdminController::class, 'destroyGuest'])->name('admin.guests.destroy');
    Route::delete('/admin/report/{id}', [AdminController::class, 'destroyReport'])->name('admin.report.destroy');
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    Route::get('/admin/profile', [AdminController::class, 'adminShow'])->name('admin-show');

    Route::get('/manage_rooms_pria', [AdminController::class, 'manage_rooms_pria'])->name('manage_rooms_pria');
    Route::post('/admin/update_email_pria/{id}', [AdminController::class, 'updateEmailPria'])->name('admin.update_email_pria');

    Route::get('/manage_rooms_perempuan', [AdminController::class, 'manage_rooms_perempuan'])->name('manage_rooms_perempuan');
    Route::post('/admin/update_email_perempuan/{id}', [AdminController::class, 'updateEmailPerempuan'])->name('admin.update_email_perempuan');

    Route::get('/add_room_images', [AdminController::class, 'add_room_images'])->name('add_room_images');
    Route::post('/admin/add_room_images', [AdminController::class, 'add_images'])->name('admin.add_room_images');

    Route::get('/admin/manage_reservations', [AdminController::class, 'manage_reservations'])->name('manage_reservations');
    Route::post('/admin/search_email', [AdminController::class, 'search_email'])->name('admin.search_email');


    // Route::get('/home', [AdminController::class, 'index'])->name('home');
    // Route::get('/admin/profile', [AdminController::class, 'adminShow'])->name('admin-show');

    // Route::get('/manage_rooms_pria', [AdminController::class, 'manage_rooms_pria'])->name('manage_rooms_pria');
    // Route::post('/admin/update_email_pria/{id}', [AdminController::class, 'updateEmailPria'])->name('admin.update_email_pria');

    // Route::get('/manage_rooms_perempuan', [AdminController::class, 'manage_rooms_perempuan'])->name('manage_rooms_perempuan');
    // Route::post('/admin/update_email_perempuan/{id}', [AdminController::class, 'updateEmailPerempuan'])->name('admin.update_email_perempuan');
});

Route::post('/submit-review', [ReviewController::class, 'submitReview'])->name('submit-review');
Route::get('/my_room', [RoomController::class, 'showMyRoom'])->name('my_room');
// Route::get('/home', [AdminController::class, 'index'])->name('home');
// Route::get('/admin/profile', [AdminController::class, 'adminShow'])->name('admin-show');

// Route::get('/manage_rooms_pria', [AdminController::class, 'manage_rooms_pria'])->name('manage_rooms_pria');
// Route::post('/admin/update_email_pria/{id}', [AdminController::class, 'updateEmailPria'])->name('admin.update_email_pria');

// Route::get('/manage_rooms_perempuan', [AdminController::class, 'manage_rooms_perempuan'])->name('manage_rooms_perempuan');
// Route::post('/admin/update_email_perempuan/{id}', [AdminController::class, 'updateEmailPerempuan'])->name('admin.update_email_perempuan');

// Route::get('/add_room_images', [AdminController::class, 'add_room_images'])->name('add_room_images');
// Route::post('/admin/add_room_images', [AdminController::class, 'add_images'])->name('admin.add_room_images');
