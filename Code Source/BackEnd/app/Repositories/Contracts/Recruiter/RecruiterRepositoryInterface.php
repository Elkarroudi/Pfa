<?php

namespace App\Repositories\Contracts\Recruiter;

use App\Models\Application;
use App\Models\Recruiter;

interface RecruiterRepositoryInterface
{
    public function recruiterJobsApplicant(Recruiter $recruiter);
    public function changeStatus(Application $application, $data);
}
