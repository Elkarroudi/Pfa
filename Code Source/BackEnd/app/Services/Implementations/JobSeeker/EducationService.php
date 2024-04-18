<?php

namespace App\Services\Implementations\JobSeeker;

use App\Models\Education;
use App\Models\JobSeeker;
use App\Repositories\Contracts\JobSeeker\EducationRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\JobSeeker\EducationServiceInterface;
use Illuminate\Http\Request;

class EducationService extends BaseService implements EducationServiceInterface
{
    protected EducationRepositoryInterface $educationRepository;
    public function __construct(EducationRepositoryInterface $educationRepository)
    { $this->educationRepository = $educationRepository; }



    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            $jobSeeker = JobSeeker::find((new JobSeeker())->getId('job_seekers'));
            return $this->responseWithSuccess($this->educationRepository->index($jobSeeker));
        }
        return $this->incorrectHttpMethod();
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $validatedData = $request->validate([
                    'university' => 'required',
                    'field_of_study' => 'required',
                    'start_date' => 'required|date',
                    'graduation_date' => 'required|date',
                ]);
            } catch (\Illuminate\Validation\ValidationException $validationException)
            { return $this->responseWithErrors($validationException->validator->errors()->all()); }

            $validatedData['job_seeker_id'] = (new JobSeeker())->getId('job_seekers');
            $education = $this->educationRepository->create($validatedData);
            return $this->responseWithSuccess($education);
        }
        return $this->incorrectHttpMethod();
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('PUT')) {
            if ($this->checkOwnerShipAndAvailability($education = Education::find($id))) {

                try {
                    $validatedData = $request->validate([
                        'university' => 'required',
                        'field_of_study' => 'required',
                        'start_date' => 'required|date',
                        'graduation_date' => 'required|date',
                    ]);
                } catch (\Illuminate\Validation\ValidationException $validationException)
                { return $this->responseWithErrors($validationException->validator->errors()->all()); }

                if ($this->educationRepository->update($education, $validatedData))
                { return $this->responseWithSuccess($education); }

                return $this->responseWithErrors("Error Updating Education !");
            }
            return $this->responseWithErrors("Unauthorized Or Education Not Found !");
        }
        return $this->incorrectHttpMethod();
    }

    public function delete(Request $request, $id)
    {
        if ($request->isMethod('Delete')) {
            if ($this->checkOwnerShipAndAvailability($education = Education::find($id))) {
                if ($this->educationRepository->delete($education))
                { return $this->responseWithSuccess("Education Deleted Successfully !"); }
                return $this->responseWithErrors("Error Deleting Education !");
            }
            return $this->responseWithErrors("Unauthorized Or Education Not Found !");
        }
        return $this->incorrectHttpMethod();
    }

    public function checkOwnerShipAndAvailability($education)
    {
        if ($education && $education->job_seeker_id === (new JobSeeker())->getId('job_seekers')) { return true; }
        return false;
    }
}
