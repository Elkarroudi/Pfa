<?php

namespace App\Repositories\Contracts\Auth;

interface RegistrationRepositoryInterface
{
    public function registration($data, $userModel);
}
