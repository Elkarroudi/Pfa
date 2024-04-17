<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['recruiter_id', 'company_id', 'title', 'overview', 'responsibilities', 'requirements', 'location', 'salary', 'employment_type', 'post_date', 'status', 'expiration_date'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', ];
    protected $casts = ['post_date' => 'date', 'expiration_date' => 'date', ];

    public function company(): BelongsTo
    { return $this->belongsTo(Company::class, 'company_id'); }

    public function recruiter(): BelongsTo
    { return $this->belongsTo(Recruiter::class, 'recruiter_id'); }

    public function applications(): HasMany
    { return $this->hasMany(Application::class); }
}
