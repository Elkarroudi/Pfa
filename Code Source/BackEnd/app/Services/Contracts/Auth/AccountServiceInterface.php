<?php

namespace App\Services\Contracts\Auth;

use Illuminate\Http\Request;

interface AccountServiceInterface
{
    public function accountInformation(Request $request);
    public function updateAccountInformation(Request $request);
    public function updatePassword(Request $request);
}
