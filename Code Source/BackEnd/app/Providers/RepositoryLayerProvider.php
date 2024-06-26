<?php

namespace App\Providers;

use App\Repositories\Contracts\Admin\AdminRepositoryInterface;
use App\Repositories\Contracts\Admin\CompanyRepositoryInterface;
use App\Repositories\Contracts\Auth\AccountRepositoryInterface;
use App\Repositories\Contracts\Auth\RegistrationRepositoryInterface;
use App\Repositories\Contracts\JobSeeker\ApplicationRepositoryInterface;
use App\Repositories\Contracts\JobSeeker\BookmarkRepositoryInterface;
use App\Repositories\Contracts\JobSeeker\EducationRepositoryInterface;
use App\Repositories\Contracts\JobSeeker\ExperienceRepositoryInterface;
use App\Repositories\Contracts\Public\WebsiteRepositoryInterface;
use App\Repositories\Contracts\Recruiter\ListingRepositoryInterface;
use App\Repositories\Contracts\Recruiter\RecruiterRepositoryInterface;
use App\Repositories\Implementations\Admin\AdminRepository;
use App\Repositories\Implementations\Admin\CompanyRepository;
use App\Repositories\Implementations\Auth\AccountRepository;
use App\Repositories\Implementations\Auth\RegistrationRepository;
use App\Repositories\Implementations\JobSeeker\ApplicationRepository;
use App\Repositories\Implementations\JobSeeker\BookmarkRepository;
use App\Repositories\Implementations\JobSeeker\EducationRepository;
use App\Repositories\Implementations\JobSeeker\ExperienceRepository;
use App\Repositories\Implementations\Public\WebsiteRepository;
use App\Repositories\Implementations\Recruiter\ListingRepository;
use App\Repositories\Implementations\Recruiter\RecruiterRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryLayerProvider extends ServiceProvider
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
        app()->bind(RegistrationRepositoryInterface::class, RegistrationRepository::class);
        app()->bind(AccountRepositoryInterface::class, AccountRepository::class);
        app()->bind(WebsiteRepositoryInterface::class, WebsiteRepository::class);

        /* Admin */
        app()->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        app()->bind(AdminRepositoryInterface::class, AdminRepository::class);

        /* Job Seeker */
        app()->bind(EducationRepositoryInterface::class, EducationRepository::class);
        app()->bind(ExperienceRepositoryInterface::class, ExperienceRepository::class);
        app()->bind(ApplicationRepositoryInterface::class, ApplicationRepository::class);
        app()->bind(BookmarkRepositoryInterface::class, BookmarkRepository::class);

        /* Recruiter */
        app()->bind(ListingRepositoryInterface::class, ListingRepository::class);
        app()->bind(RecruiterRepositoryInterface::class, RecruiterRepository::class);
    }
}
