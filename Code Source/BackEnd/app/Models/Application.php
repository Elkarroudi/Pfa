<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['job_seeker_id', 'listing_id', 'date', 'status', ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', ];
    protected $casts = ['date' => 'date', ];

    public function job_seeker(): BelongsTo
    { return $this->belongsTo(JobSeeker::class, 'job_seeker_id'); }

    public function listing(): BelongsTo
    { return $this->belongsTo(Listing::class, 'listing_id'); }
}
