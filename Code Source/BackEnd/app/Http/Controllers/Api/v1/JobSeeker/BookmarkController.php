<?php

namespace App\Http\Controllers\Api\v1\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\Contracts\JobSeeker\BookmarkServiceInterface;
use Illuminate\Http\Request;
use Mockery\Exception;

class BookmarkController extends Controller
{
    protected BookmarkServiceInterface $bookmarkService;
    public function __construct(BookmarkServiceInterface $bookmarkService)
    { $this->bookmarkService = $bookmarkService; }


    public function index(Request $request) {
        try {
            return $this->bookmarkService->index($request);
        } catch (Exception $e) { return $this->responseWithErrors("Bookmark", "Index", $e); }
    }

    public function create(Request $request) {
        try {
            return $this->bookmarkService->create($request);
        } catch (Exception $e) { return $this->responseWithErrors("Bookmark", "Create", $e); }
    }

    public function delete(Request $request, $id) {
        try {
            return $this->bookmarkService->delete($request, $id);
        } catch (Exception $e) { return $this->responseWithErrors("Bookmark", "Delete", $e); }
    }
}
