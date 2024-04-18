<?php

namespace App\Services\Contracts\Recruiter;

use Illuminate\Http\Request;

interface ListingServiceInterface
{
    public function index(Request $request);
    public function create(Request $request);
    public function update(Request $request, $id);
    public function delete(Request $request, $id);

    public function checkOwnerShipAndAvailability($listing);
}
