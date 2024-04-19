<?php

namespace App\Repositories\Implementations\Public;

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
        $listings = Listing::withoutTrashed()
            ->where('status', '=', 'Approved')
            ->where('title', 'LIKE', '%'. $arguments['query'] .'%')
            ->with('company');

        if (array_key_exists('location', $arguments))
        { return $listings->where('location', 'LIKE', '%'. $arguments['location'] .'%')->get(); }

        return $listings->get();
    }
}
