<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreateReport;
use App\Http\Controllers\CreateGuest;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CreateReservation;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\FacilitiesController;

Route::get('/', function () {
    return view('welcome');
    })->name('welcome');
Route::get('/facilities', [FacilitiesController::class, 'index'])->name('fasilitas');
Route::get('/reserve_room', function () {
    return view('reserve-room');
})->name('reserve-room');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/view_rooms/{id?}/{gender?}', function ($id, $gender) {
        return view('user.view-rooms', compact('id', 'gender'));
    })->name('view_rooms');
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
    Route::post('/cancel_room', [UserController::class, 'cancel_room'])->name('cancel_reservation');
    Route::post('/submit-review', [ReviewController::class, 'submitReview'])->name('submit-review');
    Route::get('/my_room', [RoomController::class, 'showMyRoom'])->name('my_room');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/admin/guests/{id}', [AdminController::class, 'destroyGuest'])->name('admin.guests.destroy');
    Route::delete('/admin/report/{id}', [AdminController::class, 'destroyReport'])->name('admin.report.destroy');
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    Route::get('/admin/profile', [AdminController::class, 'adminShow'])->name('admin-show');

    // Route::get('/manage_rooms_pria', [AdminController::class, 'manage_rooms_pria'])->name('manage_rooms_pria');
    // Route::post('/admin/update_email_pria/{id}', [AdminController::class, 'updateEmailPria'])->name('admin.update_email_pria');

    // Route::get('/manage_rooms_perempuan', [AdminController::class, 'manage_rooms_perempuan'])->name('manage_rooms_perempuan');
    // Route::post('/admin/update_email_perempuan/{id}', [AdminController::class, 'updateEmailPerempuan'])->name('admin.update_email_perempuan');

    Route::get('/add_room_images', [AdminController::class, 'add_room_images'])->name('add_room_images');
    Route::post('/admin/add_room_images', [AdminController::class, 'add_images'])->name('admin.add_room_images');

    Route::get('/admin/manage_reservations', [AdminController::class, 'manage_reservations'])->name('manage_reservations');
    Route::get('/admin/manage_payments', [AdminController::class, 'manage_payments'])->name('manage_payments');
    Route::post('/admin/search_email', [AdminController::class, 'search_email'])->name('admin.search_email');
    Route::post('/admin/update_reservation', [AdminController::class, 'update_reservation'])->name('admin.update_reservation');
    Route::post('/admin/update_payment', [AdminController::class, 'update_payment'])->name('admin.update_payment');


    // Route::get('/home', [AdminController::class, 'index'])->name('home');
    // Route::get('/admin/profile', [AdminController::class, 'adminShow'])->name('admin-show');

    // Route::get('/manage_rooms_pria', [AdminController::class, 'manage_rooms_pria'])->name('manage_rooms_pria');
    // Route::post('/admin/update_email_pria/{id}', [AdminController::class, 'updateEmailPria'])->name('admin.update_email_pria');

    // Route::get('/manage_rooms_perempuan', [AdminController::class, 'manage_rooms_perempuan'])->name('manage_rooms_perempuan');
    // Route::post('/admin/update_email_perempuan/{id}', [AdminController::class, 'updateEmailPerempuan'])->name('admin.update_email_perempuan');
});
// Route::get('/home', [AdminController::class, 'index'])->name('home');
// Route::get('/admin/profile', [AdminController::class, 'adminShow'])->name('admin-show');

// Route::get('/manage_rooms_pria', [AdminController::class, 'manage_rooms_pria'])->name('manage_rooms_pria');
// Route::post('/admin/update_email_pria/{id}', [AdminController::class, 'updateEmailPria'])->name('admin.update_email_pria');

// Route::get('/manage_rooms_perempuan', [AdminController::class, 'manage_rooms_perempuan'])->name('manage_rooms_perempuan');
// Route::post('/admin/update_email_perempuan/{id}', [AdminController::class, 'updateEmailPerempuan'])->name('admin.update_email_perempuan');

// Route::get('/add_room_images', [AdminController::class, 'add_room_images'])->name('add_room_images');
// Route::post('/admin/add_room_images', [AdminController::class, 'add_images'])->name('admin.add_room_images');

// Route::get('/fasilitas', function () {
//     return view('fasilitas');
// })->name('fasilitas');

// Route::get('/facilities', function () {
//     return view('facilities');
// })->name('facilities');
