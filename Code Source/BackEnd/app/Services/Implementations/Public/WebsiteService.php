<?php

namespace App\Services\Implementations\Public;

use App\Models\Recruiter;
use App\Repositories\Contracts\Public\WebsiteRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\Public\WebsiteServiceInterface;
use Illuminate\Http\Request;

class WebsiteService extends BaseService implements WebsiteServiceInterface
{
    protected WebsiteRepositoryInterface $websiteRepository;
    public function __construct(WebsiteRepositoryInterface $websiteRepository)
    { $this->websiteRepository = $websiteRepository; }



    public function validatedListing(Request $request)
    {
        if ($request->isMethod('GET')) {
            return $this->responseWithSuccess($this->websiteRepository->validatedListing());
        }
        return $this->incorrectHttpMethod();
    }

    public function search(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $arguments = $request->validate(['query' => 'required']);
                if ($request->has('location')) { $arguments['location'] = $request->input('location'); }
            } catch (\Illuminate\Validation\ValidationException $validationException) { return $this->responseWithErrors($validationException->validator->errors()->all()); }
            return $this->responseWithSuccess($this->websiteRepository->search($arguments));
        }
        return $this->incorrectHttpMethod();
    }
}
