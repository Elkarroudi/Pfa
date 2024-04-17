<?php

namespace App\Services\Implementations\Auth;

use App\Models\Admin;
use App\Models\JobSeeker;
use App\Models\Recruiter;
use App\Repositories\Contracts\Auth\RegistrationRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\Auth\RegistrationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegistrationService extends BaseService implements RegistrationServiceInterface
{
    protected RegistrationRepositoryInterface $registrationRepository;
    public function __construct(RegistrationRepositoryInterface $registrationRepository) { $this->registrationRepository = $registrationRepository; }


    public function jobSeeker(Request $request)
    {
        if ($request->isMethod('POST')) {
            return $this->register($request, 'Job Seeker', JobSeeker::class);
        }
        return $this->incorrectHttpMethod();
    }

    public function recruiter(Request $request)
    {
        if ($request->isMethod('POST')) {
            return $this->register($request, 'Recruiter', Recruiter::class);
        }
        return $this->incorrectHttpMethod();
    }

    public function register(Request $request, $userType, $class)
    {
        try {
            $userData = $request->validate([
                'name' => "required",
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => "required|min:6|max:50",
            ]);
        } catch (\Illuminate\Validation\ValidationException $validationException) { return $this->responseWithErrors($validationException->validator->errors()->all()); }

        $userData['username'] = '@' . uniqid();
        $userData['type'] = $userType;

        $newUser= $this->registrationRepository->registration($userData, $class);
        if ($newUser) { return $this->responseWithSuccess("You are successfully registered In Our Platform"); }
        return $this->responseWithErrors("Error Registering A New " . $userType);
    }

    public function admin(Request $request)
    {
        if ($request->isMethod('POST')) {
            return $this->register($request, 'Admin', Admin::class);
        }
        return $this->incorrectHttpMethod();
    }
}
