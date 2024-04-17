<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['admin_id', 'name', 'website', 'logo', 'slogan', ];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', ];

    public function admin(): BelongsTo
    { return $this->belongsTo(Admin::class, 'admin_id'); }

    public function listings(): HasMany
    { return $this->hasMany(Listing::class); }
}
