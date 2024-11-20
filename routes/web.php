<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\Admin\LoginController;
use App\Models\User;
use App\Models\Role;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::get('/app', function () {
    return view('layouts.app');
})->name('app');


Route::prefix('admin')->group(function () {
    // Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    
        // Roles CRUD
        Route::resource('roles', RoleController::class);

        // Organizers CRUD
        Route::resource('organizers', OrganizerController::class);
        
        Route::get('/dashboard', function() {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
    Route::middleware(['auth:admin'])->group(function () {

    });
});


Route::resource('users', UserController::class);