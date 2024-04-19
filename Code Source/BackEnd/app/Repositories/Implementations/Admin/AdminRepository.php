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
            'Listings' => Listing::withoutTrashed()->count(),
            'Trashed_listings' => Listing::onlyTrashed()->count(),
            'Applications' => Application::withoutTrashed()->count(),
            'Companies' => Company::withoutTrashed()->count(),
        ];
    }
}
