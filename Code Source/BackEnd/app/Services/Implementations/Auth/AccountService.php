<?php

namespace App\Services\Implementations\Auth;

use App\Repositories\Contracts\Auth\AccountRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\Auth\AccountServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountService extends BaseService implements AccountServiceInterface
{
    protected AccountRepositoryInterface $accountRepository;
    public function __construct(AccountRepositoryInterface $accountRepository)
    { $this->accountRepository = $accountRepository; }



    public function accountInformation(Request $request)
    {
        if ($request->isMethod('GET')) {
            return $this->accountRepository->userInformation();
        }
        return $this->incorrectHttpMethod();
    }

    public function updateAccountInformation(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $validatedData = $request->validate([
                    'name' => "required",
                    'email' => ['required', 'email', Rule::unique('users', 'email')->ignore(auth()->id())],
                ]);
            } catch (\Illuminate\Validation\ValidationException $validationException) { return $this->responseWithErrors($validationException->validator->errors()->all()); }

            if ($this->accountRepository->updateInformation($validatedData))
            { return $this->responseWithSuccess("Account Information Updated Successfully !"); }

            return $this->responseWithErrors("Error Updating Account Information !");
        }
        return $this->incorrectHttpMethod();
    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $credential = $request->validate(['password' => "required|min:6|max:50",]);
            } catch (\Illuminate\Validation\ValidationException $validationException) { return $this->responseWithErrors($validationException->validator->errors()->all()); }

            if ($this->accountRepository->updateInformation($credential))
            { return $this->responseWithSuccess("Password Updated Successfully !"); }

            return $this->responseWithErrors("Error Updating Password !");
        }
        return $this->incorrectHttpMethod();
    }
}
