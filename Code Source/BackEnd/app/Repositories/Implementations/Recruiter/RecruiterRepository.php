<?php

namespace App\Repositories\Implementations\Recruiter;

use App\Models\Application;
use App\Models\Recruiter;
use App\Repositories\Contracts\Recruiter\RecruiterRepositoryInterface;

class RecruiterRepository implements RecruiterRepositoryInterface
{
    public function recruiterJobsApplicant(Recruiter $recruiter)
    {
        $data = $recruiter->listings()
            ->with('applications.job_seeker.user')
            ->select('id', 'title', 'post_date', 'expiration_date');

        return [
            'listings_count' => $data->count(),
            'listings' => $data->get(),
        ];
    }

    public function changeStatus(Application $application, $data)
    {
        return $application->update($data);
    }
}
