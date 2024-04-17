<?php

namespace App\Services\Contracts\Admin;

use Illuminate\Http\Request;

interface CompanyServiceInterface
{
    public function index(Request $request);
    public function create(Request $request);
    public function update(Request $request, $id);
    public function delete(Request $request, $id);
}
