<?php

use App\Http\Controllers\Controllersview\CategoryController;
use App\Http\Controllers\Controllersview\OrderController;
use App\Http\Controllers\Controllersview\OrganizerController;
use App\Http\Controllers\Controllersview\TalentController;
use App\Http\Controllers\Controllersview\UserController;
use App\Http\Controllers\Controllersview\EventController;
use App\Http\Controllers\ParticipantAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;


// Route::middleware(['auth', 'role:owner'])->get('/', function () {
//     return view('layouts.app');
// });

// ROUTE OWNER
Route::prefix('owner')->middleware(['auth', 'role:owner'])->group(function () {
    Route::get('dashboard', function(){
        return view('owner.dashboard');
    })->name('owner.dashboard');
    Route::resource('organizers', UserController::class)->names([
        'index' => 'owner.organizers.index',
        'create' => 'owner.organizers.create',
        'store' => 'owner.organizers.store',
        'update' => 'owner.organizers.update',
        'destroy' => 'owner.organizers.destroy',
    ]);
    Route::get('/events', function(){
        $events = \App\Models\Event::whereHas('user', function ($query) {
            $query->where('created_by', auth()->id());
        })->get();
        return view('owner.events.index', compact('events'));
    })->name('owner.events');
    Route::get('/events/approve/{id}', 'App\Http\Controllers\Controllersview\EventController@approveEvent')->name('events.approve');
    Route::resource('orders', OrderController::class);
});


// ROUTE ORGANIZER
Route::prefix('organizer')->middleware(['auth', 'role:organizer'])->group(function () {
    Route::get('dashboard', function(){
        return view('organizer.dashboard');
    })->name('organizer.dashboard');
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'organizer.categories.index',
        'create' => 'organizer.categories.create',
        'store' => 'organizer.categories.store',
        'update' => 'organizer.categories.update',
        'destroy' => 'organizer.categories.destroy',
    ]);
    Route::resource('talents', TalentController::class)->names([
        'index' => 'organizer.talents.index',
        'create' => 'organizer.talents.create',
        'store' => 'organizer.talents.store',
        'update' => 'organizer.talents.update',
        'destroy' => 'organizer.talents.destroy',
    ]);
    Route::resource('events', EventController::class);
});

// ROUTE ADMIN
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('orders', CategoryController::class);
});

// ROUTE AUTH UNTUK USER
Route::prefix('auth')->group(function () {
    Auth::routes();
});

Route::get('/', [HomeController::class, 'index']);

// ROUTE PARTICIPANT
Route::prefix('participant')->group(function () {
    Route::get('/login', [ParticipantAuthController::class, 'showLoginForm'])->name('participant.login');
    Route::post('/login', [ParticipantAuthController::class, 'login']);
    Route::get('/register', [ParticipantAuthController::class, 'showRegistForm'])->name('participant.register');
    Route::post('/register', [ParticipantAuthController::class, 'register']);
    Route::post('/logout', [ParticipantAuthController::class, 'logout'])->name('participant.logout');
});

// ROUTE LOGIN PARTICIPAN WITH GOOGLE
Route::get('oauth/google', [\App\Http\Controllers\OauthController::class, 'redirectToProvider'])->name('oauth.google');  
Route::get('oauth/google/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallback'])->name('oauth.google.callback');

