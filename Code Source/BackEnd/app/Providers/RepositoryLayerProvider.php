<?php

namespace App\Providers;

use App\Repositories\Contracts\Admin\CompanyRepositoryInterface;
use App\Repositories\Contracts\Auth\RegistrationRepositoryInterface;
use App\Repositories\Contracts\JobSeeker\EducationRepositoryInterface;
use App\Repositories\Contracts\JobSeeker\ExperienceRepositoryInterface;
use App\Repositories\Implementations\Admin\CompanyRepository;
use App\Repositories\Implementations\Auth\RegistrationRepository;
use App\Repositories\Implementations\JobSeeker\EducationRepository;
use App\Repositories\Implementations\JobSeeker\ExperienceRepository;
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

        /* Admin */
        app()->bind(CompanyRepositoryInterface::class, CompanyRepository::class);

        /* Job Seeker */
        app()->bind(EducationRepositoryInterface::class, EducationRepository::class);
        app()->bind(ExperienceRepositoryInterface::class, ExperienceRepository::class);
    }
}
