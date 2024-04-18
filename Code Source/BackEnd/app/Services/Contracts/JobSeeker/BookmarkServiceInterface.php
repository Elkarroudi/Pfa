<?php

namespace App\Services\Contracts\JobSeeker;

use Illuminate\Http\Request;

interface BookmarkServiceInterface
{
    public function index(Request $request);
    public function create(Request $request);
    public function delete(Request $request, $id);

    public function checkOwnerShipAndAvailability($bookmark);
}
