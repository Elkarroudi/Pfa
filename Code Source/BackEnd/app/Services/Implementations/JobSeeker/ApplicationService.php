<?php

namespace App\Services\Implementations\JobSeeker;

use App\Models\Application;
use App\Models\JobSeeker;
use App\Repositories\Contracts\JobSeeker\ApplicationRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\JobSeeker\ApplicationServiceInterface;
use Illuminate\Http\Request;

class ApplicationService extends BaseService implements ApplicationServiceInterface
{
    protected ApplicationRepositoryInterface $applicationRepository;
    public function __construct(ApplicationRepositoryInterface $applicationRepository)
    { $this->applicationRepository = $applicationRepository; }



    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            $jobSeeker = JobSeeker::find((new JobSeeker())->getId('job_seekers'));
            return $this->responseWithSuccess($this->applicationRepository->index($jobSeeker));
        }
        return $this->incorrectHttpMethod();
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $validatedData = $request->validate(['listing_id' => 'required' ]);
            } catch (\Illuminate\Validation\ValidationException $validationException)
            { return $this->responseWithErrors($validationException->validator->errors()->all()); }

            $validatedData['date'] = date('Y-m-d');
            $validatedData['job_seeker_id'] = (new JobSeeker())->getId('job_seekers');
            $application = $this->applicationRepository->create($validatedData);
            return $this->responseWithSuccess($application);
        }
        return $this->incorrectHttpMethod();
    }

    public function delete(Request $request, $id)
    {
        if ($request->isMethod('Delete')) {
            if ($this->checkOwnerShipAndAvailability($application = Application::find($id))) {
                if ($this->applicationRepository->delete($application))
                { return $this->responseWithSuccess("Application Deleted Successfully !"); }
                return $this->responseWithErrors("Error Deleting Application !");
            }
            return $this->responseWithErrors("Unauthorized Or Application Not Found !");
        }
        return $this->incorrectHttpMethod();
    }

    public function checkOwnerShipAndAvailability($application)
    {
        if ($application && $application->job_seeker_id === (new JobSeeker())->getId('job_seekers')) { return true; }
        return false;
    }
}
