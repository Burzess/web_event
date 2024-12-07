<?php

use App\Http\Controllers\TicketCategoryController;
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

});
// CRUD Roles
Route::resource('roles', RoleController::class);

// CRUD Organizers
Route::resource('organizers', OrganizerController::class);

// Rute untuk Category
Route::resource('categories', CategoryController::class);

// Rute untuk Users
Route::resource('users', UserController::class);

// Rute untuk Images
Route::resource('images', ImageController::class);
Route::middleware('web')->group(function () {
    Route::resource('images', ImageController::class);
});

// Route tambahan jika ingin membuat route spesifik
Route::resource('talents', TalentController::class);

// Rute untuk Events
Route::resource('events', EventController::class);

//tiket categories

Route::prefix('ticket-categories')->group(function () {
    Route::get('/', [TicketCategoryController::class, 'index'])->name('ticket_categories.index'); // Halaman utama daftar ticket categories
    Route::get('/create', [TicketCategoryController::class, 'create'])->name('ticket_categories.create'); // Halaman untuk tambah data
    Route::post('/', [TicketCategoryController::class, 'store'])->name('ticket_categories.store'); // Proses simpan data baru
    Route::get('/{id}/edit', [TicketCategoryController::class, 'edit'])->name('ticket_categories.edit'); // Halaman edit
    Route::put('/{id}', [TicketCategoryController::class, 'update'])->name('ticket_categories.update'); // Proses update
    Route::delete('/{id}', [TicketCategoryController::class, 'destroy'])->name('ticket_categories.destroy'); // Proses hapus data
});

