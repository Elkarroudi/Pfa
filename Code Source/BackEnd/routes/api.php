<?php

use App\Http\Controllers\Api\v1\Auth\AuthenticationController;
use App\Http\Controllers\Api\v1\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {

    Route::middleware('notLoggedIn')->group(function () {
        Route::any('/auth/register/seeker/', [RegistrationController::class, 'jobSeeker']);
        Route::any('/auth/register/recruiter/', [RegistrationController::class, 'recruiter']);
        Route::any('/auth/login/', [AuthenticationController::class, 'login']);
    });

    Route::middleware('isLoggedIn')->group(function () {
        Route::any('/auth/refresh/', [AuthenticationController::class, 'refresh']);
        Route::any('/auth/logout/', [AuthenticationController::class, 'logout']);
    });
});
