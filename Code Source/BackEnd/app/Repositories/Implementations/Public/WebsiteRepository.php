<?php

namespace App\Repositories\Implementations\Public;

use App\Models\Company;
use App\Models\Listing;
use App\Models\User;
use App\Repositories\Contracts\Public\WebsiteRepositoryInterface;

class WebsiteRepository implements WebsiteRepositoryInterface
{

    public function validatedListing()
    {
        return Listing::withoutTrashed()
            ->where('status', '=', 'Approved')
            ->with('company')
            ->get();
    }

    public function search($arguments)
    {
        return Listing::withoutTrashed()
            ->where('status', '=', 'Approved')
            ->where('title', 'LIKE', '%'. $arguments['query'] .'%')
            ->where('location', 'LIKE', '%'. $arguments['location'] .'%')
            ->with('company')
            ->get();

    }

    public function company()
    {
        return Company::withoutTrashed()->get();
    }
}
