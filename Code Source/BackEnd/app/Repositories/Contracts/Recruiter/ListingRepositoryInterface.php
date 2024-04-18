<?php

namespace App\Repositories\Contracts\Recruiter;

use App\Models\Listing;
use App\Models\Recruiter;

interface ListingRepositoryInterface
{
    public function index(Recruiter $recruiter);
    public function create($data);
    public function update(Listing $listing, $data);
    public function delete(Listing $listing);
}
