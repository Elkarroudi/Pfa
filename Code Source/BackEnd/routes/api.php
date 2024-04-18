<?php

use App\Http\Controllers\Api\v1\Admin\CompanyController;
use App\Http\Controllers\Api\v1\Auth\AuthenticationController;
use App\Http\Controllers\Api\v1\Auth\RegistrationController;
use App\Http\Controllers\Api\v1\JobSeeker\EducationController;
use App\Http\Controllers\Api\v1\JobSeeker\ExperienceController;
use App\Http\Controllers\Api\v1\Recruiter\ListingController;
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

    /* Route That Require Non-Authenticated User */
    Route::middleware('notLoggedIn')->group(function () {
        Route::any('/auth/register/seeker/', [RegistrationController::class, 'jobSeeker']);
        Route::any('/auth/register/recruiter/', [RegistrationController::class, 'recruiter']);
        Route::any('/auth/login/', [AuthenticationController::class, 'login']);

        Route::any('/auth/admin/', [RegistrationController::class, 'admin']); // To Delete After
    });

    /* Route That Require Authenticated User */
    Route::middleware('isLoggedIn')->group(function () {
        Route::any('/auth/refresh/', [AuthenticationController::class, 'refresh']);
        Route::any('/auth/logout/', [AuthenticationController::class, 'logout']);

        /* Admin Routes =============== */
        Route::middleware('access:Admin')->group(function () {
            Route::prefix('company')->group(function () {
                Route::any('/all/', [CompanyController::class, 'index']);
                Route::any('/create/', [CompanyController::class, 'create']);
                Route::any('/update/{id}/', [CompanyController::class, 'update']);
                Route::any('/delete/{id}/', [CompanyController::class, 'delete']);
            });
        });

        /* Job Seeker Routes =============== */
        Route::middleware('access:Job Seeker')->group(function () {
            Route::prefix('education')->group(function () {
                Route::any('/all/', [EducationController::class, 'index']);
                Route::any('/create/', [EducationController::class, 'create']);
                Route::any('/update/{id}/', [EducationController::class, 'update']);
                Route::any('/delete/{id}/', [EducationController::class, 'delete']);
            });

            Route::prefix('experience')->group(function () {
                Route::any('/all/', [ExperienceController::class, 'index']);
                Route::any('/create/', [ExperienceController::class, 'create']);
                Route::any('/update/{id}/', [ExperienceController::class, 'update']);
                Route::any('/delete/{id}/', [ExperienceController::class, 'delete']);
            });

        });

        /* Recruiter Routes =============== */
        Route::middleware('access:Recruiter')->group(function () {
            Route::prefix('listing')->group(function () {
                Route::any('/all/', [ListingController::class, 'index']);
                Route::any('/create/', [ListingController::class, 'create']);
                Route::any('/update/{id}/', [ListingController::class, 'update']);
                Route::any('/delete/{id}/', [ListingController::class, 'delete']);
            });
        });


    });
});
