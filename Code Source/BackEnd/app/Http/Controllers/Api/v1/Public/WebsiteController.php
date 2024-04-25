<?php

namespace App\Http\Controllers\Api\v1\Public;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Listing;
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

    public function company(Request $request)
    {
        try {
            return $this->websiteService->company($request);
        } catch (Exception $e) { return $this->responseWithErrors("Website", "Search", $e); }
    }

    public function companies(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'data' => [
                    [ 'id' => 1, 'name' => 'Jumia', 'logo' => 'RrDE8CosYVIkF8MDiQrCIVfUSYxqgUyo8KBSGy4Z.png', ],
                    [ 'id' => 1, 'name' => 'Capgemini', 'logo' => 'ITEh3Bbj4QpVzzmTRIL5RSiSJCdOsV7iTCQfzwr4.png', ],
                    [ 'id' => 1, 'name' => 'Inetum', 'logo' => '47nJxfU74EZr4HT62AYQJw6rlnYuT0mZenTf7xjM.png', ],
                    [ 'id' => 1, 'name' => 'Akkodis', 'logo' => 'VkTyYV5pfMAUnziCHUC3HzsIR9Efy0wef6j80jEW.png', ],
                    [ 'id' => 1, 'name' => 'Amazon', 'logo' => 'YtdabAfqAlXyw6UlUklhTBBJOHxijJJZ1qFiA9Ak.png', ],
                ],
            ]);
        } catch (Exception $e) { return $this->responseWithErrors("Website", "companies", $e); }
    }

    public function getListingDetails(Request $request, $id)
    {
        try {
            $listing = Listing::where('id', '=', $id);
            return response()->json([
                'status' => true,
                'data' => $listing->with('company')->with('applications')->with('recruiter.user')->get(),
            ]);
        } catch (Exception $e) { return $this->responseWithErrors("Website", "getListingDetails", $e); }
    }

}
