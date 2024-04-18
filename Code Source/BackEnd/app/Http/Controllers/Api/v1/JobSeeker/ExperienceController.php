<?php

namespace App\Http\Controllers\Api\v1\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\Contracts\JobSeeker\ExperienceServiceInterface;
use Illuminate\Http\Request;
use Mockery\Exception;

class ExperienceController extends Controller
{
    protected ExperienceServiceInterface $experienceService;
    public function __construct(ExperienceServiceInterface $experienceService)
    { $this->experienceService = $experienceService; }



    public function index(Request $request) {
        try {
            return $this->experienceService->index($request);
        } catch (Exception $e) { return $this->responseWithErrors("Experience", "Index", $e); }
    }

    public function create(Request $request) {
        try {
            return $this->experienceService->create($request);
        } catch (Exception $e) { return $this->responseWithErrors("Experience", "Create", $e); }
    }

    public function update(Request $request, $id) {
        try {
            return $this->experienceService->update($request, $id);
        } catch (Exception $e) { return $this->responseWithErrors("Experience", "Update", $e); }
    }

    public function delete(Request $request, $id) {
        try {
            return $this->experienceService->delete($request, $id);
        } catch (Exception $e) { return $this->responseWithErrors("Experience", "Delete", $e); }
    }
}
