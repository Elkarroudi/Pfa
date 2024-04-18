<?php

namespace App\Repositories\Implementations\JobSeeker;

use App\Models\Education;
use App\Models\JobSeeker;
use App\Repositories\Contracts\JobSeeker\EducationRepositoryInterface;

class EducationRepository implements EducationRepositoryInterface
{
    public function index(JobSeeker $jobSeeker)
    {
        return $jobSeeker->educations()->get();
    }

    public function create($data)
    {
        return Education::create($data);
    }

    public function update(Education $education, $data)
    {
        return $education->update($data);
    }

    public function delete(Education $education)
    {
        return $education->delete();
    }
}
