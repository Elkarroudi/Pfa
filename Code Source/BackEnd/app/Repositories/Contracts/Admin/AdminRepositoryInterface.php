<?php

namespace App\Repositories\Contracts\Admin;

use App\Models\Listing;

interface AdminRepositoryInterface
{
    public function recruitersListings();
    public function changeStatus(Listing $listing, $status);
    public function statistics();
}
