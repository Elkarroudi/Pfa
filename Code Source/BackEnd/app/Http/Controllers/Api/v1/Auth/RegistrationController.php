<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Auth\RegistrationServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class RegistrationController extends Controller
{
    protected RegistrationServiceInterface $registrationService;
    public function __construct(RegistrationServiceInterface $registrationService) { $this->registrationService = $registrationService; }



    public function jobSeeker(Request $request)
    {
        try {
            return $this->registrationService->jobSeeker($request);
        } catch (Exception $e) { return $this->responseWithErrors("Registration", "JobSeeker", $e); }
    }

    public function recruiter(Request $request)
    {
        try {
            return $this->registrationService->recruiter($request);
        } catch (Exception $e) { return $this->responseWithErrors("Registration", "Recruiter", $e); }
    }


    public function admin(Request $request)
    {
        try {
            return $this->registrationService->admin($request);
        } catch (Exception $e) { return $this->responseWithErrors("Registration", "Admin", $e); }
    }
}
