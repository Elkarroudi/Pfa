<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['name', 'username', 'email', 'password', 'type', ];
    protected $hidden = ['password', 'email_verified_at', 'remember_token', 'created_at', 'updated_at', 'deleted_at', ];
    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed', ];

    public function admin(): HasOne
    { return $this->hasOne(Admin::class); }

    public function recruiter(): HasOne
    { return $this->hasOne(Recruiter::class); }

    public function job_seeker(): HasOne
    { return $this->hasOne(JobSeeker::class); }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
