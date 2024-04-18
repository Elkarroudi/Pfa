<?php

namespace App\Repositories\Contracts\JobSeeker;

use App\Models\Bookmark;
use App\Models\JobSeeker;

interface BookmarkRepositoryInterface
{
    public function index(JobSeeker $jobSeeker);
    public function create($data);
    public function delete(Bookmark $bookmark);
}
