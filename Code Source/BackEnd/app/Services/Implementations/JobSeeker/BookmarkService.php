<?php

namespace App\Services\Implementations\JobSeeker;

use App\Models\Bookmark;
use App\Models\JobSeeker;
use App\Models\Listing;
use App\Repositories\Contracts\JobSeeker\BookmarkRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\JobSeeker\BookmarkServiceInterface;
use Illuminate\Http\Request;

class BookmarkService extends BaseService implements BookmarkServiceInterface
{
    protected BookmarkRepositoryInterface $bookmarkRepository;
    public function __construct(BookmarkRepositoryInterface $bookmarkRepository)
    { $this->bookmarkRepository = $bookmarkRepository; }



    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            $jobSeeker = JobSeeker::find((new JobSeeker())->getId('job_seekers'));
            return $this->responseWithSuccess($this->bookmarkRepository->index($jobSeeker));
        }
        return $this->incorrectHttpMethod();
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $validatedData = $request->validate(['listing_id' => 'required', ]);
            } catch (\Illuminate\Validation\ValidationException $validationException)
            { return $this->responseWithErrors($validationException->validator->errors()->all()); }

            if (Listing::find($validatedData['listing_id'])) {
                $validatedData['job_seeker_id'] = (new JobSeeker())->getId('job_seekers');
                $bookmark = $this->bookmarkRepository->create($validatedData);
                return $this->responseWithSuccess($bookmark);
            }
            return $this->responseWithErrors('Listing Not Found To Create A Bookmark !');
        }
        return $this->incorrectHttpMethod();
    }

    public function delete(Request $request, $id)
    {
        if ($request->isMethod('Delete')) {
            if ($this->checkOwnerShipAndAvailability($bookmark = Bookmark::find($id))) {
                if ($this->bookmarkRepository->delete($bookmark))
                { return $this->responseWithSuccess("Bookmark Deleted Successfully !"); }
                return $this->responseWithErrors("Error Deleting Bookmark !");
            }
            return $this->responseWithErrors("Unauthorized Or Bookmark Not Found !");
        }
        return $this->incorrectHttpMethod();
    }

    public function checkOwnerShipAndAvailability($bookmark)
    {
        if ($bookmark && $bookmark->job_seeker_id === (new JobSeeker())->getId('job_seekers')) { return true; }
        return false;
    }
}
