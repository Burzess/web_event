<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizerController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('roles', RoleController::class); // Menggunakan resource route

Route::resource('organizers', OrganizerController::class); // Menggunakan resource route


Route::resource('users', UserController::class); // Menggunakan resource route
