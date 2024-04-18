<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Auth\AccountServiceInterface;
use Illuminate\Http\Request;
use Mockery\Exception;

class AccountController extends Controller
{
    protected AccountServiceInterface $accountService;
    public function __construct(AccountServiceInterface $accountService)
    { $this->accountService = $accountService; }



    public function accountInformation(Request $request)
    {
        try {
            return $this->accountService->accountInformation($request);
        } catch (Exception $e) { return $this->responseWithErrors("Account", "Account Information", $e); }
    }

    public function updateAccountInformation(Request $request)
    {
        try {
            return $this->accountService->updateAccountInformation($request);
        } catch (Exception $e) { return $this->responseWithErrors("Account", "Update Account Information", $e); }
    }

    public function updatePassword(Request $request)
    {
        try {
            return $this->accountService->updatePassword($request);
        } catch (Exception $e) { return $this->responseWithErrors("Account", "Update Password", $e); }
    }

}
