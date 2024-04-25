<?php

namespace App\Services\Implementations\JobSeeker;

use App\Models\Experience;
use App\Models\JobSeeker;
use App\Repositories\Contracts\JobSeeker\ExperienceRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\JobSeeker\ExperienceServiceInterface;
use Illuminate\Http\Request;

class ExperienceService extends BaseService implements ExperienceServiceInterface
{
    protected ExperienceRepositoryInterface $experienceRepository;
    public function __construct(ExperienceRepositoryInterface $experienceRepository)
    { $this->experienceRepository = $experienceRepository; }


    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            $jobSeeker = JobSeeker::find((new JobSeeker())->getId('job_seekers'));
            return $this->responseWithSuccess($this->experienceRepository->index($jobSeeker));
        }
        return $this->incorrectHttpMethod();
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $validatedData = $request->validate([
                    'title' => 'required',
                    'location' => 'required',
                    'company' => 'required',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                ]);
            } catch (\Illuminate\Validation\ValidationException $validationException)
            { return $this->responseWithErrors($validationException->validator->errors()->all()); }

            $validatedData['job_seeker_id'] = (new JobSeeker())->getId('job_seekers');
            $experience = $this->experienceRepository->create($validatedData);
            return $this->responseWithSuccess($experience);
        }
        return $this->incorrectHttpMethod();
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('PUT')) {
            if ($this->checkOwnerShipAndAvailability($experience = Experience::find($id))) {

                try {
                    $validatedData = $request->validate([
                        'title' => 'required',
                        'location' => 'required',
                        'company' => 'required',
                    ]);
                } catch (\Illuminate\Validation\ValidationException $validationException)
                { return $this->responseWithErrors($validationException->validator->errors()->all()); }

                if ($this->experienceRepository->update($experience, $validatedData))
                { return $this->responseWithSuccess($experience); }

                return $this->responseWithErrors("Error Updating Experience !");
            }
            return $this->responseWithErrors("Unauthorized Or Experience Not Found !");
        }
        return $this->incorrectHttpMethod();
    }

    public function delete(Request $request, $id)
    {
        if ($request->isMethod('Delete')) {
            if ($this->checkOwnerShipAndAvailability($experience = Experience::find($id))) {
                if ($this->experienceRepository->delete($experience))
                { return $this->responseWithSuccess("Experience Deleted Successfully !"); }
                return $this->responseWithErrors("Error Deleting Experience !");
            }
            return $this->responseWithErrors("Unauthorized Or Experience Not Found !");
        }
        return $this->incorrectHttpMethod();
    }

    public function checkOwnerShipAndAvailability($experience)
    {
        if ($experience && $experience->job_seeker_id === (new JobSeeker())->getId('job_seekers')) { return true; }
        return false;
    }
}
