<?php

namespace App\Repositories\Implementations\Admin;

use App\Models\Application;
use App\Models\Company;
use App\Models\Listing;
use App\Models\User;
use App\Repositories\Contracts\Admin\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{

    public function recruitersListings()
    {
        return Listing::withoutTrashed()->get();
    }

    public function changeStatus(Listing $listing, $status)
    {
        return $listing->update($status);
    }

    public function statistics()
    {
        return [
            'jobSeekers' => User::withoutTrashed()->where('type', '=', 'Job Seeker')->count(),
            'recruiters' => User::withoutTrashed()->where('type', '=', 'Recruiter')->count(),
            'admins' => User::withoutTrashed()->where('type', '=', 'Admin')->count(),
            'listings' => Listing::withoutTrashed()->count(),
            'trashed_listings' => Listing::onlyTrashed()->count(),
            'applications' => Application::withoutTrashed()->count(),
            'companies' => Company::withoutTrashed()->count(),
        ];
    }

    public function users()
    {
        return User::withoutTrashed()->get();
    }
}
