<?php

namespace App\Repositories\Implementations\JobSeeker;

use App\Models\Bookmark;
use App\Models\JobSeeker;
use App\Repositories\Contracts\JobSeeker\BookmarkRepositoryInterface;

class BookmarkRepository implements BookmarkRepositoryInterface
{

    public function index(JobSeeker $jobSeeker)
    {
        return $jobSeeker->bookmarks()->with('listing.company')->orderBy('created_at', 'DESC')->get();
    }

    public function create($data)
    {
        return Bookmark::create($data);
    }

    public function delete(Bookmark $bookmark)
    {
        return $bookmark->delete();
    }
}
