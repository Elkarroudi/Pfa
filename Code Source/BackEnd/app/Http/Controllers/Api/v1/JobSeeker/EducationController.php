<?php

namespace App\Http\Controllers\Api\v1\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\Contracts\JobSeeker\EducationServiceInterface;
use Illuminate\Http\Request;
use Mockery\Exception;

class EducationController extends Controller
{
    protected EducationServiceInterface $educationService;
    public function __construct(EducationServiceInterface $educationService)
    { $this->educationService = $educationService; }



    public function index(Request $request) {
        try {
            return $this->educationService->index($request);
        } catch (Exception $e) { return $this->responseWithErrors("Education", "Index", $e); }
    }

    public function create(Request $request) {
        try {
            return $this->educationService->create($request);
        } catch (Exception $e) { return $this->responseWithErrors("Education", "Create", $e); }
    }

    public function update(Request $request, $id) {
        try {
            return $this->educationService->update($request, $id);
        } catch (Exception $e) { return $this->responseWithErrors("Education", "Update", $e); }
    }

    public function delete(Request $request, $id) {
        try {
            return $this->educationService->delete($request, $id);
        } catch (Exception $e) { return $this->responseWithErrors("Education", "Delete", $e); }
    }

}
