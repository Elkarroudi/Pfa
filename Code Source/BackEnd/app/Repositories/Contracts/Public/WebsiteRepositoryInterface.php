<?php

namespace App\Repositories\Contracts\Public;

use Illuminate\Http\Request;

interface WebsiteRepositoryInterface
{
    public function validatedListing();
    public function search($arguments);
    public function company();

}
