<?php

namespace App\Providers;

use App\Repositories\Contracts\Admin\CompanyRepositoryInterface;
use App\Repositories\Contracts\Auth\RegistrationRepositoryInterface;
use App\Repositories\Implementations\Admin\CompanyRepository;
use App\Repositories\Implementations\Auth\RegistrationRepository;
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
        app()->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
    }
}
