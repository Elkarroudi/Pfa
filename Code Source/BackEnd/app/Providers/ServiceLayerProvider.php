<?php

namespace App\Providers;

use App\Services\Contracts\Admin\AdminServiceInterface;
use App\Services\Contracts\Admin\CompanyServiceInterface;
use App\Services\Contracts\Auth\AccountServiceInterface;
use App\Services\Contracts\Auth\AuthenticationServiceInterface;
use App\Services\Contracts\Auth\RegistrationServiceInterface;
use App\Services\Contracts\JobSeeker\ApplicationServiceInterface;
use App\Services\Contracts\JobSeeker\BookmarkServiceInterface;
use App\Services\Contracts\JobSeeker\EducationServiceInterface;
use App\Services\Contracts\JobSeeker\ExperienceServiceInterface;
use App\Services\Contracts\Public\WebsiteServiceInterface;
use App\Services\Contracts\Recruiter\ListingServiceInterface;
use App\Services\Contracts\Recruiter\RecruiterServiceInterface;
use App\Services\Implementations\Admin\AdminService;
use App\Services\Implementations\Admin\CompanyService;
use App\Services\Implementations\Auth\AccountService;
use App\Services\Implementations\Auth\AuthenticationService;
use App\Services\Implementations\Auth\RegistrationService;
use App\Services\Implementations\JobSeeker\ApplicationService;
use App\Services\Implementations\JobSeeker\BookmarkService;
use App\Services\Implementations\JobSeeker\EducationService;
use App\Services\Implementations\JobSeeker\ExperienceService;
use App\Services\Implementations\Public\WebsiteService;
use App\Services\Implementations\Recruiter\ListingService;
use App\Services\Implementations\Recruiter\RecruiterService;
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
        app()->bind(AccountServiceInterface::class, AccountService::class);
        app()->bind(WebsiteServiceInterface::class, WebsiteService::class);

        /* Admin */
        app()->bind(CompanyServiceInterface::class, CompanyService::class);
        app()->bind(AdminServiceInterface::class, AdminService::class);

        /* Job Seeker */
        app()->bind(EducationServiceInterface::class, EducationService::class);
        app()->bind(ExperienceServiceInterface::class, ExperienceService::class);
        app()->bind(ApplicationServiceInterface::class, ApplicationService::class);
        app()->bind(BookmarkServiceInterface::class, BookmarkService::class);

        /* Recruiter */
        app()->bind(ListingServiceInterface::class, ListingService::class);
        app()->bind(RecruiterServiceInterface::class, RecruiterService::class);
    }
}
