<?php

namespace App\Services\Contracts\JobSeeker;

use App\Models\Education;
use Illuminate\Http\Request;

interface EducationServiceInterface
{
    public function index(Request $request);
    public function create(Request $request);
    public function update(Request $request, $id);
    public function delete(Request $request, $id);

    public function checkOwnerShipAndAvailability($education);
}
