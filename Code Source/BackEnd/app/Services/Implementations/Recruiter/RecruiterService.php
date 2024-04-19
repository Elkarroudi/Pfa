<?php

namespace App\Services\Implementations\Recruiter;

use App\Models\Application;
use App\Models\Recruiter;
use App\Repositories\Contracts\Recruiter\RecruiterRepositoryInterface;
use App\Services\BaseService;
use App\Services\Contracts\Recruiter\RecruiterServiceInterface;
use Illuminate\Http\Request;

class RecruiterService extends BaseService implements RecruiterServiceInterface
{
    protected RecruiterRepositoryInterface $recruiterRepository;
    public function __construct(RecruiterRepositoryInterface $recruiterRepository)
    { $this->recruiterRepository = $recruiterRepository; }



    public function recruiterJobsApplicant(Request $request)
    {
        if ($request->isMethod('GET')) {
            $recruiter = Recruiter::find((new Recruiter())->getId('recruiters'));
            return $this->responseWithSuccess($this->recruiterRepository->recruiterJobsApplicant($recruiter));
        }
        return $this->incorrectHttpMethod();
    }

    public function changeStatus(Request $request, $status, $id)
    {
        if ($request->isMethod('POST')) {

            if ($application = Application::find($id)) {
                if ($this->recruiterRepository->changeStatus($application, ['status' => $status]))
                { return $this->responseWithSuccess("Status Updated Successfully"); }
                return $this->responseWithErrors("Error Updated Status");
            }
            return $this->responseWithErrors('Application Not Found To Update');

        }
        return $this->incorrectHttpMethod();
    }
}
