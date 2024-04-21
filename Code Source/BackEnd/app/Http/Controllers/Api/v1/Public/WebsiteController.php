<?php

namespace App\Http\Controllers\Api\v1\Public;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Services\Contracts\Public\WebsiteServiceInterface;
use Illuminate\Http\Request;
use Mockery\Exception;

class WebsiteController extends Controller
{
    protected WebsiteServiceInterface $websiteService;
    public function __construct(WebsiteServiceInterface $websiteService)
    { $this->websiteService = $websiteService; }


    public function validatedListing(Request $request)
    {
        try {
            return $this->websiteService->validatedListing($request);
        } catch (Exception $e) { return $this->responseWithErrors("Website", "Validated Listing", $e); }
    }

    public function search(Request $request)
    {
        try {
            return $this->websiteService->search($request);
        } catch (Exception $e) { return $this->responseWithErrors("Website", "Search", $e); }
    }

    public function companies(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'data' => Company::withoutTrashed()->get(),
            ]);
        } catch (Exception $e) { return $this->responseWithErrors("Website", "companies", $e); }
    }

}
