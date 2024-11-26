<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

// Halaman login untuk admin
Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

// Rute admin dengan prefix 'admin' dan menggunakan middleware otentikasi
Route::prefix('admin')->middleware(['auth:admin'])->group(function () {

    // Rute login admin (menampilkan form dan proses login)
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    // Dashboard admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD Roles
    Route::resource('roles', RoleController::class);

    // CRUD Organizers
    Route::resource('organizers', OrganizerController::class);
});

// Rute untuk Category
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');
});

// Rute untuk Users
Route::resource('users', UserController::class);

// Rute untuk Images
Route::prefix('images')->group(function () {
    Route::get('/', [ImageController::class, 'index'])->name('images.index');
    Route::get('/{id}', [ImageController::class, 'show'])->name('images.show');
});

// Rute untuk Talents
Route::post('talents', [TalentController::class, 'store'])->name('talents.store');
Route::resource('talents', TalentController::class);
Route::post('talents', [TalentController::class, 'store']);

// Rute untuk Events
Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events.index');
    Route::get('/{id}', [EventController::class, 'show'])->name('events.show');
});
