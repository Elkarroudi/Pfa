<?php

namespace App\Services\Contracts\Auth;

use Illuminate\Http\Request;

interface RegistrationServiceInterface
{
    public function jobSeeker(Request $request);
    public function recruiter(Request $request);
    public function register(Request $request, $userType, $class);
    public function admin(Request $request);
}
