<?php

namespace App\Repositories\Implementations\Auth;

use App\Models\User;
use App\Repositories\Contracts\Auth\RegistrationRepositoryInterface;

class RegistrationRepository implements RegistrationRepositoryInterface
{
    public function registration($data, $userModel)
    {
        $user = User::create($data);
        $userModel::create(['user_id' => $user->id]);

        return $user;
    }
}
