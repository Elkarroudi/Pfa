<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Admin\AdminServiceInterface;
use Illuminate\Http\Request;
use Mockery\Exception;

class AdminController extends Controller
{
    protected AdminServiceInterface $adminService;
    public function __construct(AdminServiceInterface $adminService)
    { $this->adminService = $adminService; }



    public function recruitersListings(Request $request) {
        try {
            return $this->adminService->recruitersListings($request);
        } catch (Exception $e) { return $this->responseWithErrors("Admin", "recruiterListing", $e); }
    }

    public function changeStatus(Request $request, $status, $id) {
        try {
            return $this->adminService->changeStatus($request, $status, $id);
        } catch (Exception $e) { return $this->responseWithErrors("Admin", "changeStatus", $e); }
    }

    public function statistics(Request $request)
    {
        try {
            return $this->adminService->statistics($request);
        } catch (Exception $e) { return $this->responseWithErrors("Admin", "statistics", $e); }
    }

    public function registerAnAdmin(Request $request)
    {
        try {
            return $this->adminService->registerAnAdmin($request);
        } catch (Exception $e) { return $this->responseWithErrors("Admin", "registerAnAdmin", $e); }
    }

    public function users(Request $request)
    {
        try {
            return $this->adminService->users($request);
        } catch (Exception $e) { return $this->responseWithErrors("Admin", "users", $e); }
    }
}
