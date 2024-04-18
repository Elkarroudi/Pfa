<?php

namespace App\Repositories\Implementations\Recruiter;

use App\Models\Listing;
use App\Models\Recruiter;
use App\Repositories\Contracts\Recruiter\ListingRepositoryInterface;

class ListingRepository implements ListingRepositoryInterface
{

    public function index(Recruiter $recruiter)
    {
        return $recruiter->listings()->get();
    }

    public function create($data)
    {
        return Listing::create($data);
    }

    public function update(Listing $listing, $data)
    {
        return $listing->update($data);
    }

    public function delete(Listing $listing)
    {
        return $listing->delete();
    }
}
