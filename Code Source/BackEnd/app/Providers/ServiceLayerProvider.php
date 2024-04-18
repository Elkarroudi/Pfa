<?php

namespace App\Providers;

use App\Services\Contracts\Admin\CompanyServiceInterface;
use App\Services\Contracts\Auth\AuthenticationServiceInterface;
use App\Services\Contracts\Auth\RegistrationServiceInterface;
use App\Services\Contracts\JobSeeker\EducationServiceInterface;
use App\Services\Contracts\JobSeeker\ExperienceServiceInterface;
use App\Services\Contracts\Recruiter\ListingServiceInterface;
use App\Services\Implementations\Admin\CompanyService;
use App\Services\Implementations\Auth\AuthenticationService;
use App\Services\Implementations\Auth\RegistrationService;
use App\Services\Implementations\JobSeeker\EducationService;
use App\Services\Implementations\JobSeeker\ExperienceService;
use App\Services\Implementations\Recruiter\ListingService;
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
        app()->bind(ExperienceServiceInterface::class, ExperienceService::class);

        /* Recruiter */
        app()->bind(ListingServiceInterface::class, ListingService::class);
    }
}
