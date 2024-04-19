<?php

namespace App\Services\Contracts\Admin;

use \Illuminate\Http\Request;

interface AdminServiceInterface
{
    public function recruitersListings(Request $request);
    public function changeStatus(Request $request, $status, $id);
    public function statistics(Request $request);
    public function registerAnAdmin(Request $request);
}
