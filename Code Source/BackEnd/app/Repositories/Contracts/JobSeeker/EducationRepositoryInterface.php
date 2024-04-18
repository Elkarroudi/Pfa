<?php

namespace App\Repositories\Contracts\JobSeeker;

use App\Models\Education;
use App\Models\JobSeeker;

interface EducationRepositoryInterface
{
    public function index(JobSeeker $jobSeeker);
    public function create($data);
    public function update(Education $education, $data);
    public function delete(Education $education);
}
