<?php

namespace App\Services\Contracts\Recruiter;

use Illuminate\Http\Request;

interface RecruiterServiceInterface
{
    public function recruiterJobsApplicant(Request $request);
    public function changeStatus(Request $request, $status, $id);
    public function statistics(Request $request);
}
