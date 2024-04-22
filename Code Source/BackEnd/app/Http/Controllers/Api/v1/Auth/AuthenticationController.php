<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Auth\AuthenticationServiceInterface;
use Illuminate\Http\Request;
use Mockery\Exception;

class AuthenticationController extends Controller
{
    protected AuthenticationServiceInterface $authenticationService;
    public function __construct(AuthenticationServiceInterface $authenticationService)
    { $this->authenticationService = $authenticationService; }


    public function login(Request $request)
    {
        try {
            return $this->authenticationService->login($request);
        } catch (Exception $e) { return $this->responseWithErrors("Authentication", "Login", $e); }
    }

    public function refresh(Request $request)
    {
        try {
            return $this->authenticationService->refresh($request);
        } catch (Exception $e) { return $this->responseWithErrors("Authentication", "Refresh", $e); }
    }

    public function logout(Request $request)
    {
        try {
            return $this->authenticationService->logout($request);
        } catch (Exception $e) { return $this->responseWithErrors("Authentication", "Logout", $e); }
    }

    public function check(Request $request)
    {
        try {
            return $this->authenticationService->check($request);
        } catch (Exception $e) { return $this->responseWithErrors("Authentication", "Check", $e); }
    }
}
