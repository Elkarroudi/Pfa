<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Admin\CompanyServiceInterface;
use Illuminate\Http\Request;
use Mockery\Exception;

class CompanyController extends Controller
{
    protected CompanyServiceInterface $companyService;
    public function __construct(CompanyServiceInterface $companyService)
    { $this->companyService = $companyService; }



    public function index(Request $request) {
        try {
            return $this->companyService->index($request);
        } catch (Exception $e) { return $this->responseWithErrors("Company", "Index", $e); }
    }

    public function create(Request $request) {
        try {
            return $this->companyService->create($request);
        } catch (Exception $e) { return $this->responseWithErrors("Company", "Create", $e); }
    }

    public function update(Request $request, $id) {
        try {
            return $this->companyService->update($request, $id);
        } catch (Exception $e) { return $this->responseWithErrors("Company", "Update", $e); }
    }

    public function delete(Request $request, $id) {
        try {
            return $this->companyService->delete($request, $id);
        } catch (Exception $e) { return $this->responseWithErrors("Company", "Delete", $e); }
    }
}
