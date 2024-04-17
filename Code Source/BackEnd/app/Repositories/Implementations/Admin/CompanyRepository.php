<?php

namespace App\Repositories\Implementations\Admin;

use App\Models\Company;
use App\Repositories\Contracts\Admin\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{

    public function index()
    {
        return Company::withoutTrashed()->get();
    }

    public function create($data)
    {
        return Company::create($data);
    }

    public function update(Company $company, $data)
    {
        return $company->update($data);
    }

    public function delete(Company $company)
    {
        return $company->delete();
    }
}
