<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobSeeker extends BaseModel
{
    use HasFactory;

    protected $fillable = ['user_id', ];
    protected $hidden = ['created_at', 'updated_at', ];

    public function user(): BelongsTo
    { return $this->belongsTo(User::class, 'user_id'); }

    public function educations(): HasMany
    { return $this->hasMany(Education::class); }

    public function experiences(): HasMany
    { return $this->hasMany(Experience::class); }

    public function applications(): HasMany
    { return $this->hasMany(Application::class); }

    public function bookmarks(): HasMany
    { return $this->hasMany(Bookmark::class); }
}
