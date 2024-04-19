<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Recruiter extends BaseModel
{
    use HasFactory;

    protected $fillable = ['user_id', ];
    protected $hidden = ['created_at', 'updated_at', ];

    public function user(): BelongsTo
    { return $this->belongsTo(User::class, 'user_id'); }

    public function listings(): HasMany
    { return $this->hasMany(Listing::class); }

    public function applications(): HasManyThrough
    { return $this->hasManyThrough(Application::class, Listing::class); }
}
