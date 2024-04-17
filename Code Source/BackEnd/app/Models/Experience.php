<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['job_seeker_id', 'title', 'location', 'company', 'start_date', 'end_date'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', ];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date',];

    public function job_seeker(): BelongsTo
    { return $this->belongsTo(Experience::class, 'job_seeker_id'); }
}
