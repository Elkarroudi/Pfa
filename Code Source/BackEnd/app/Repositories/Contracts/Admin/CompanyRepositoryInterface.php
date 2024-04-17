<?php

namespace App\Repositories\Contracts\Admin;

use App\Models\Company;

interface CompanyRepositoryInterface
{
    public function index();
    public function create($data);
    public function update(Company $company, $data);
    public function delete(Company $company);
}
