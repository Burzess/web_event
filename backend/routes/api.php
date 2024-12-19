<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    UserController,
    RoleController,
    CategoryController,
    ImageController,
    TalentController,
    EventController,
    TicketCategoryController,
    OrderController,
    PaymentController,
    OrderDetailController,
    ParticipantController,
    ParticipantForgotPasswordController,
    OrganizerController,
    AuthController
};
// Authentication Route
// Route::apiResource('/login', LoginController::class);
Route::post('/login', [AuthController::class, 'login']);

// User Routes
Route::apiResource('/users', UserController::class);

// Organizer Routes
Route::apiResource('/organizers', OrganizerController::class);

// Role Routes
Route::apiResource('/roles', RoleController::class);

// Category Routes
Route::apiResource('/categories', CategoryController::class);

// Image Routes
Route::apiResource('/images', ImageController::class);

// Talent Routes (Requires Authentication)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('talents', TalentController::class);
});

// Event Routes
Route::apiResource('events', EventController::class);

// Ticket Category Routes
Route::apiResource('ticket-categories', TicketCategoryController::class);

// Participant Routes
Route::apiResource('participants', ParticipantController::class);

// Forgot Password Routes for Participants
Route::apiResource('forgot-passwords', ParticipantForgotPasswordController::class);

// Order and Payment Routes
Route::apiResource('orders', OrderController::class);
Route::apiResource('order_details', OrderDetailController::class);
Route::apiResource('payments', PaymentController::class);
