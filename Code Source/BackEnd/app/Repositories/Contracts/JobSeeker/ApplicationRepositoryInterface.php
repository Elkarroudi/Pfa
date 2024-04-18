<?php

namespace App\Repositories\Contracts\JobSeeker;

use App\Models\Application;
use App\Models\JobSeeker;

interface ApplicationRepositoryInterface
{
    public function index(JobSeeker $jobSeeker);
    public function create($data);
    public function delete(Application $application);
}
