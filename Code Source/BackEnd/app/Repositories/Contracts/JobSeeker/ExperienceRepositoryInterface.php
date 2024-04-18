<?php

namespace App\Repositories\Contracts\JobSeeker;

use App\Models\Experience;
use App\Models\JobSeeker;

interface ExperienceRepositoryInterface
{
    public function index(JobSeeker $jobSeeker);
    public function create($data);
    public function update(Experience $experience, $data);
    public function delete(Experience $experience);
}
