<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;

// Rute login
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Rute untuk mengambil data pengguna yang sedang login
Route::get('/user', function (Request $request) {
    return $request->user();
})->name('user.current');

// Rute untuk mengambil data pengguna berdasarkan ID
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

// Rute Organizer
Route::resource('organizers', OrganizerController::class);

// Rute Categories
Route::resource('categories', CategoryController::class);

// Rute Images
Route::get('images', [ImageController::class, 'index'])->name('images.index');
Route::get('images/{id}', [ImageController::class, 'show'])->name('images.show');
Route::post('images', [ImageController::class, 'store'])->name('images.store');
Route::put('images/{id}', [ImageController::class, 'update'])->name('images.update');
Route::delete('images/{id}', [ImageController::class, 'destroy'])->name('images.destroy');

// Rute Talent
Route::post('talents', [TalentController::class, 'store'])->name('talents.store');
Route::get('talents', [TalentController::class, 'index'])->name('talents.index');
Route::get('talents/{id}', [TalentController::class, 'show'])->name('talents.show');
Route::put('talents/{id}', [TalentController::class, 'update'])->name('talents.update');
Route::delete('talents/{id}', [TalentController::class, 'destroy'])->name('talents.destroy');

// Rute Event
Route::get('events', [EventController::class, 'index'])->name('events.index');
Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('events', [EventController::class, 'store'])->name('events.store');
Route::put('events/{id}', [EventController::class, 'update'])->name('events.update');
Route::delete('events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
