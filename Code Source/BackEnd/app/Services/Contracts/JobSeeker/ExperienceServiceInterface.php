<?php

namespace App\Services\Contracts\JobSeeker;

use App\Http\Requests\JobSeeker\ExperienceRequest;
use Illuminate\Http\Request;

interface ExperienceServiceInterface
{
    public function index(Request $request);
    public function create(Request $request);
    public function update(Request $request, $id);
    public function delete(Request $request, $id);

    public function checkOwnerShipAndAvailability($experience);
}
