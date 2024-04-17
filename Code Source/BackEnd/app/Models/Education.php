<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['job_seeker_id', 'university', 'field_of_study', 'start_date', 'graduation_date'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', ];
    protected $casts = ['start_date' => 'date', 'graduation_date' => 'date',];

    public function job_seeker(): BelongsTo
    { return $this->belongsTo(JobSeeker::class, 'job_seeker_id'); }
}
