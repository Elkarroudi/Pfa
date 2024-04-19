<?php

namespace App\Http\Controllers\Api\v1\Recruiter;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Recruiter\RecruiterServiceInterface;
use Illuminate\Http\Request;
use Mockery\Exception;

class RecruiterController extends Controller
{
    protected RecruiterServiceInterface $recruiterService;
    public function __construct(RecruiterServiceInterface $recruiterService)
    { $this->recruiterService = $recruiterService; }



    public function recruiterJobsApplicant(Request $request) {
        try {
            return $this->recruiterService->recruiterJobsApplicant($request);
        } catch (Exception $e) { return $this->responseWithErrors("Recruiter", "recruiterJobsApplicant", $e); }
    }

    public function changeStatus(Request $request, $status, $id) {
        try {
            return $this->recruiterService->changeStatus($request, $status, $id);
        } catch (Exception $e) { return $this->responseWithErrors("Recruiter", "changeStatus", $e); }
    }
}
