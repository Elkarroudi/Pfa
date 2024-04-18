<?php

namespace App\Http\Controllers\Api\v1\Recruiter;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Recruiter\ListingServiceInterface;
use Illuminate\Http\Request;
use Mockery\Exception;

class ListingController extends Controller
{
    protected ListingServiceInterface $listingService;
    public function __construct(ListingServiceInterface $listingService)
    { $this->listingService = $listingService; }



    public function index(Request $request) {
        try {
            return $this->listingService->index($request);
        } catch (Exception $e) { return $this->responseWithErrors("Listing", "Index", $e); }
    }

    public function create(Request $request) {
        try {
            return $this->listingService->create($request);
        } catch (Exception $e) { return $this->responseWithErrors("Listing", "Create", $e); }
    }

    public function update(Request $request, $id) {
        try {
            return $this->listingService->update($request, $id);
        } catch (Exception $e) { return $this->responseWithErrors("Listing", "Update", $e); }
    }

    public function delete(Request $request, $id) {
        try {
            return $this->listingService->delete($request, $id);
        } catch (Exception $e) { return $this->responseWithErrors("Listing", "Delete", $e); }
    }
}
