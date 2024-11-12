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
        return view('dashboard');
    })->name('dashboard');
    Route::get('/view_rooms', function () {
        $images = File::files(public_path('images/KamarPerempuan'));
        return view('user.view_rooms', compact('images'));
    })->name('view_rooms');
});

Route::get('/home', [AdminController::class, 'index'])->name('home');

Route::get('/manage_rooms_pria', [AdminController::class, 'manage_rooms_pria'])->name('manage_rooms_pria');
Route::post('/admin/update_email_pria/{id}', [AdminController::class, 'updateEmailPria'])->name('admin.update_email_pria');

Route::get('/manage_rooms_perempuan', [AdminController::class, 'manage_rooms_perempuan'])->name('manage_rooms_perempuan');
Route::post('/admin/update_email_perempuan/{id}', [AdminController::class, 'updateEmailPerempuan'])->name('admin.update_email_perempuan');