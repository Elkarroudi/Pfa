<?php

namespace App\Services\Implementations\Admin;

use App\Models\Admin;
use App\Models\Company;
use App\Repositories\Contracts\Admin\CompanyRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\Admin\CompanyServiceInterface;
use Illuminate\Http\Request;

class CompanyService extends BaseService implements CompanyServiceInterface
{
    protected CompanyRepositoryInterface $companyRepository;
    public function __construct(CompanyRepositoryInterface $companyRepository)
    { $this->companyRepository = $companyRepository; }



    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            return $this->responseWithSuccess($this->companyRepository->index());
        }
        return $this->incorrectHttpMethod();
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $model = new Admin();
            try {
                $validatedData = $request->validate([
                    "name" => "required",
                    "website" => "required",
                    "logo" => "required",
                    "slogan" => "required",
                ]);
            } catch (\Illuminate\Validation\ValidationException $validationException) { return $this->responseWithErrors($validationException->validator->errors()->all()); }

            $validatedData['admin_id'] = $model->getId('admins');
            $validatedData['logo'] = $this->storePicture($request, 'logo');
            $validatedData['slogan'] = $this->storePicture($request, 'slogan');
            return $this->response(true, 'data', $this->companyRepository->create($validatedData));
        }
        return $this->incorrectHttpMethod();
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('PUT')) {
            if ($company = Company::find($id)) {
                try {
                    $validatedData = $request->validate([
                        "name" => "required",
                        "website" => "required",
                    ]);
                } catch (\Illuminate\Validation\ValidationException $validationException) { return $this->responseWithErrors($validationException->validator->errors()->all()); }

                if ($request->hasFile('logo')) { $validatedData['slogan'] = $this->storePicture($request, 'logo'); }
                if ($request->hasFile('slogan')) { $validatedData['slogan'] = $this->storePicture($request, 'slogan', ); }

                if ($this->companyRepository->update($company, $validatedData))
                { return $this->responseWithSuccess($company); }

                return $this->responseWithErrors("Error Updating Company !");
            }
            return $this->response(false, 'errors', 'Company Not Found !');
        }
        return $this->incorrectHttpMethod();
    }

    public function delete(Request $request, $id)
    {
        if ($request->isMethod('DELETE')) {
            $companyToDelete = Company::find($id);
            if ($companyToDelete) {
                if ($this->companyRepository->delete($companyToDelete)) { return $this->responseWithSuccess("Company Deleted Successfully"); }
                return $this->responseWithSuccess("Error Deleting Company !");
            }
            return $this->responseWithErrors("Company Not Found !");
        }
        return $this->incorrectHttpMethod();
    }
}
