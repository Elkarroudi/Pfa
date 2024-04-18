<?php

namespace App\Providers;

use App\Services\Contracts\Admin\CompanyServiceInterface;
use App\Services\Contracts\Auth\AuthenticationServiceInterface;
use App\Services\Contracts\Auth\RegistrationServiceInterface;
use App\Services\Contracts\JobSeeker\EducationServiceInterface;
use App\Services\Implementations\Admin\CompanyService;
use App\Services\Implementations\Auth\AuthenticationService;
use App\Services\Implementations\Auth\RegistrationService;
use App\Services\Implementations\JobSeeker\EducationService;
use Illuminate\Support\ServiceProvider;

class ServiceLayerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        app()->bind(RegistrationServiceInterface::class, RegistrationService::class);
        app()->bind(AuthenticationServiceInterface::class, AuthenticationService::class);

        /* Admin */
        app()->bind(CompanyServiceInterface::class, CompanyService::class);

        /* Job Seeker */
        app()->bind(EducationServiceInterface::class, EducationService::class);
    }
}
