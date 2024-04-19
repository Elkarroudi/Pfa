<?php

namespace App\Services\Contracts\Public;

use Illuminate\Http\Request;

interface WebsiteServiceInterface
{
    public function validatedListing(Request $request);
    public function search(Request $request);
}
