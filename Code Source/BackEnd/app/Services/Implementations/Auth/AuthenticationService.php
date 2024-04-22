<?php

namespace App\Services\Implementations\Auth;

use App\Services\BaseService;
use App\Services\Contracts\Auth\AuthenticationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthenticationService extends BaseService implements AuthenticationServiceInterface
{
    public function login(Request $request)
    {
        if ($request->isMethod('POST')) {
            try {
                $credentials = $request->validate([
                    'email' => 'required|email',
                    'password' => "required|min:6|max:50",
                ]);
            } catch (\Illuminate\Validation\ValidationException $validationException) { return $this->responseWithErrors($validationException->validator->errors()->all()); }

            if ($token = auth()->attempt($credentials)) { return $this->responseWithSuccess(["token" => $token]); }
            return $this->responseWithErrors("Unauthorized");
        }
        return $this->incorrectHttpMethod();
    }

    public function logout(Request $request)
    {
        if ($request->isMethod('POST')) {
            auth()->logout();
            return $this->responseWithSuccess("Successfully logged out");
        }
        return $this->incorrectHttpMethod();
    }

    public function refresh(Request $request)
    {
        if ($request->isMethod('POST')) {
            return $this->responseWithSuccess(["token" => auth()->refresh()]);
        }
        return $this->incorrectHttpMethod();
    }

    public function check(Request $request)
    {
        if ($request->isMethod('GET')) {
            if (auth()->check())
            { return response()->json([
                'status' => true,
                'userType' => auth()->user()->type,
            ]); }

            return response()->json(['status' => false]);
        }
        return $this->incorrectHttpMethod();
    }

}
