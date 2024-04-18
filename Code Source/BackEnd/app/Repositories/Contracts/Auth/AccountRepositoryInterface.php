<?php

namespace App\Repositories\Contracts\Auth;


interface AccountRepositoryInterface
{
    public function updateInformation($data);
    public function userInformation();
}
