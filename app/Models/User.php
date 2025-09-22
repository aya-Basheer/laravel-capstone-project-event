<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password_hash',
        'role_id',
        'status',
        'last_login_at',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    /**
     * Get the password attribute name for authentication
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    /**
     * Get the password attribute for authentication
     */
    public function getAuthPasswordName()
    {
        return 'password_hash';
    }

    /**
     * Set password attribute
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password_hash'] = $value;
    }

    /**
     * Get password attribute
     */
    public function getPasswordAttribute()
    {
        return $this->password_hash;
    }

    /**
     * Get user role
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get user registrations
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Check if user is organizer
     */
    public function isOrganizer(): bool
    {
        return $this->role->name === 'organizer';
    }

    /**
     * Check if user is audience
     */
    public function isAudience(): bool
    {
        return $this->role->name === 'audience';
    }
}
