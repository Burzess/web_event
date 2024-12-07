<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketCategoryController;
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
Route::prefix('talents')->group(function () {
    Route::get('/', [TalentController::class, 'index']); // GET all talents
    Route::get('{id}', [TalentController::class, 'show']); // GET a single talent
    Route::post('/', [TalentController::class, 'store']); // POST new talent
    Route::put('{id}', [TalentController::class, 'update']); // PUT update talent
    Route::delete('{id}', [TalentController::class, 'destroy']); // DELETE talent
});

// Rute Event
Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index']); // Get all events
    Route::post('/', [EventController::class, 'store']); // Create a new event
    Route::get('{id}', [EventController::class, 'show']); // Get a specific event
    Route::put('{id}', [EventController::class, 'update']); // Update a specific event
    Route::delete('{id}', [EventController::class, 'destroy']); // Delete a specific event
});


Route::prefix('ticket-categories')->group(function () {
    Route::get('/', [TicketCategoryController::class, 'index']);
    Route::post('/', [TicketCategoryController::class, 'store']);
    Route::get('/{id}', [TicketCategoryController::class, 'show']);
    Route::put('/{id}', [TicketCategoryController::class, 'update']);
    Route::delete('/{id}', [TicketCategoryController::class, 'destroy']);
});

