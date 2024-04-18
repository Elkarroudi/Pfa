<?php

namespace App\Repositories\Implementations\JobSeeker;

use App\Models\Experience;
use App\Models\JobSeeker;
use App\Repositories\Contracts\JobSeeker\ExperienceRepositoryInterface;

class ExperienceRepository implements ExperienceRepositoryInterface
{

    public function index(JobSeeker $jobSeeker)
    {
        return $jobSeeker->experiences()->get();
    }

    public function create($data)
    {
        return Experience::create($data);
    }

    public function update(Experience $experience, $data)
    {
        return $experience->update($data);
    }

    public function delete(Experience $experience)
    {
        return $experience->delete();
    }
}
