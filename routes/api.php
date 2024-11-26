<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Mengambil data pengguna berdasarkan ID
Route::get('/user/{id}', [UserController::class, 'show']);
