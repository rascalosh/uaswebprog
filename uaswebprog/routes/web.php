<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
        $imagesPria = File::files(public_path('images/KamarPria'));
        return view('dashboard', compact('imagesPerempuan', 'imagesPria'));
    })->name('dashboard');
    Route::get('/view_rooms', function () {
        return view('user.view-rooms');
    })->name('view_rooms');
    Route::get('/reserve_room', function () {
        return view('user.reserve-room');
    })->name('reserve_room');
});


Route::get('/home', [AdminController::class, 'index'])->name('home');
Route::get('/admin/profile', [AdminController::class, 'adminShow'])->name('admin-show');

Route::get('/manage_rooms_pria', [AdminController::class, 'manage_rooms_pria'])->name('manage_rooms_pria');
Route::post('/admin/update_email_pria/{id}', [AdminController::class, 'updateEmailPria'])->name('admin.update_email_pria');

Route::get('/manage_rooms_perempuan', [AdminController::class, 'manage_rooms_perempuan'])->name('manage_rooms_perempuan');
Route::post('/admin/update_email_perempuan/{id}', [AdminController::class, 'updateEmailPerempuan'])->name('admin.update_email_perempuan');