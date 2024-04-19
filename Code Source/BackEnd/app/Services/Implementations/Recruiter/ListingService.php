<?php

namespace App\Services\Implementations\Recruiter;

use App\Models\JobSeeker;
use App\Models\Listing;
use App\Models\Recruiter;
use App\Repositories\Contracts\Recruiter\ListingRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\Recruiter\ListingServiceInterface;
use Illuminate\Http\Request;

class ListingService extends BaseService implements ListingServiceInterface
{
    protected ListingRepositoryInterface $listingRepository;
    public function __construct(ListingRepositoryInterface $listingRepository)
    { $this->listingRepository = $listingRepository; }



    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            $recruiter = Recruiter::find((new Recruiter())->getId('recruiters'));
            return $this->responseWithSuccess($this->listingRepository->index($recruiter));
        }
        return $this->incorrectHttpMethod();
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $validatedData = $request->validate([
                    'company_id' => 'required',
                    'title' => 'required',
                    'overview' => 'required',
                    'responsibilities' => 'required',
                    'requirements' => 'required',
                    'location' => 'required',
                    'salary' => 'required',
                    'employment_type' => 'required',
                    'post_date' => 'required',
                    'expiration_date' => 'required'
                ]);
            } catch (\Illuminate\Validation\ValidationException $validationException)
            { return $this->responseWithErrors($validationException->validator->errors()->all()); }

            $validatedData['recruiter_id'] = (new Recruiter())->getId('recruiters');
            $listing = $this->listingRepository->create($validatedData);
            return $this->responseWithSuccess($listing);
        }
        return $this->incorrectHttpMethod();
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('PUT')) {
            if ($this->checkOwnerShipAndAvailability($listing = Listing::find($id))) {

                try {
                    $validatedData = $request->validate([
                        'title' => 'required',
                        'overview' => 'required',
                        'responsibilities' => 'required',
                        'requirements' => 'required',
                        'location' => 'required',
                        'salary' => 'required',
                        'employment_type' => 'required',
                        'expiration_date' => 'required'
                    ]);
                } catch (\Illuminate\Validation\ValidationException $validationException)
                { return $this->responseWithErrors($validationException->validator->errors()->all()); }

                if ($this->listingRepository->update($listing, $validatedData))
                { return $this->responseWithSuccess($listing); }

                return $this->responseWithErrors("Error Updating Listing !");
            }
            return $this->responseWithErrors("Unauthorized Or Listing Not Found !");
        }
        return $this->incorrectHttpMethod();
    }

    public function delete(Request $request, $id)
    {
        if ($request->isMethod('Delete')) {
            if ($this->checkOwnerShipAndAvailability($listing = Listing::find($id))) {
                if ($this->listingRepository->delete($listing))
                { return $this->responseWithSuccess("Listing Deleted Successfully !"); }
                return $this->responseWithErrors("Error Deleting Listing !");
            }
            return $this->responseWithErrors("Unauthorized Or Listing Not Found !");
        }
        return $this->incorrectHttpMethod();
    }

    public function checkOwnerShipAndAvailability($listing)
    {
        if ($listing && $listing->recruiter_id === (new Recruiter())->getId('recruiters')) { return true; }
        return false;
    }
}
