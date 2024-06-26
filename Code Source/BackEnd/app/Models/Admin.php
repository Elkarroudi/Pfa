<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends BaseModel
{
    use HasFactory;

    protected $fillable = ['user_id', ];
    protected $hidden = ['created_at', 'updated_at', ];

    public function user(): BelongsTo
    { return $this->belongsTo(User::class, 'user_id'); }

    public function companies(): HasMany
    { return $this->hasMany(Company::class); }
}
