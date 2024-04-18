<?php

namespace App\Http\Controllers\Api\v1\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\Contracts\JobSeeker\ApplicationServiceInterface;
use Illuminate\Http\Request;
use Mockery\Exception;

class ApplicationController extends Controller
{
    protected ApplicationServiceInterface $applicationService;
    public function __construct(ApplicationServiceInterface $applicationService)
    { $this->applicationService = $applicationService; }


    public function index(Request $request) {
        try {
            return $this->applicationService->index($request);
        } catch (Exception $e) { return $this->responseWithErrors("Application", "Index", $e); }
    }

    public function create(Request $request) {
        try {
            return $this->applicationService->create($request);
        } catch (Exception $e) { return $this->responseWithErrors("Application", "Create", $e); }
    }

    public function delete(Request $request, $id) {
        try {
            return $this->applicationService->delete($request, $id);
        } catch (Exception $e) { return $this->responseWithErrors("Application", "Delete", $e); }
    }
}
