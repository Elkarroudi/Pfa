<?php

namespace App\Repositories\Implementations\JobSeeker;

use App\Models\Application;
use App\Models\JobSeeker;
use App\Repositories\Contracts\JobSeeker\ApplicationRepositoryInterface;

class ApplicationRepository implements ApplicationRepositoryInterface
{

    public function index(JobSeeker $jobSeeker)
    {
        return $jobSeeker->applications()->with('listing')->get();
    }

    public function create($data)
    {
        return Application::create($data);
    }

    public function delete(Application $application)
    {
       return $application->delete();
    }
}
