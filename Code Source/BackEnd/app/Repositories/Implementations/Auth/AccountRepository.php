<?php

namespace App\Repositories\Implementations\Auth;

use App\Models\User;
use App\Repositories\Contracts\Auth\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{

    public function updateInformation($data)
    {
        return User::find(auth()->id())->update($data);
    }

    public function userInformation()
    {
        return auth()->user();
    }
}
