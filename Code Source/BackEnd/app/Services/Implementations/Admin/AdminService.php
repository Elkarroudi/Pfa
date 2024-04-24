<?php

namespace App\Services\Implementations\Admin;

use App\Models\Admin;
use App\Models\Application;
use App\Models\Listing;
use App\Repositories\Contracts\Admin\AdminRepositoryInterface;
use App\Repositories\Contracts\Auth\RegistrationRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\Admin\AdminServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminService extends BaseService implements AdminServiceInterface
{
    protected AdminRepositoryInterface $adminRepository;
    protected RegistrationRepositoryInterface $registrationRepository;
    public function __construct(AdminRepositoryInterface $adminRepository, RegistrationRepositoryInterface $registrationRepository)
    {   $this->adminRepository = $adminRepository;
        $this->registrationRepository = $registrationRepository; }



    public function recruitersListings(Request $request)
    {
        if ($request->isMethod('GET')) {
            return $this->responseWithSuccess($this->adminRepository->recruitersListings());
        }
        return $this->incorrectHttpMethod();
    }

    public function changeStatus(Request $request, $status, $id)
    {
        if ($request->isMethod('POST')) {
            if ($listing = Listing::find($id)) {
                if ($this->adminRepository->changeStatus($listing, ['status' => $status]))
                { return $this->responseWithSuccess("Status Updated Successfully"); }
                return $this->responseWithErrors("Error Updated Status");
            }
            return $this->responseWithErrors('Listing Not Found To Update');
        }
        return $this->incorrectHttpMethod();
    }

    public function statistics(Request $request)
    {
        if ($request->isMethod('GET')) {
            return $this->responseWithSuccess($this->adminRepository->statistics());
        }
        return $this->incorrectHttpMethod();
    }

    public function registerAnAdmin(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $userData = $request->validate([
                    'name' => "required",
                    'email' => ['required', 'email', Rule::unique('users', 'email')],
                    'password' => "required|min:6|max:50",
                ]);
            } catch (\Illuminate\Validation\ValidationException $validationException) { return $this->responseWithErrors($validationException->validator->errors()->all()); }

            $userData['username'] = '@' . uniqid();
            $userData['type'] = "Admin";

            return $this->responseWithSuccess($this->registrationRepository->registration($userData, Admin::class));
        }
        return $this->incorrectHttpMethod();
    }

    public function users(Request $request)
    {
        if ($request->isMethod('GET')) {
            return $this->responseWithSuccess($this->adminRepository->users());
        }
        return $this->incorrectHttpMethod();
    }
}
