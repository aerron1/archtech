<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'position',
        'is_active', // Add this
         'status_changed_at',
    'profile_picture', // Make sure this is included!
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // Add position options as a constant
    public const POSITIONS = [
        'Operations Manager',
        'Sales Executive',
        'Sales Marketing',
        'Admin'
    ];

    // Check if user is the seeder admin
    public function isSeederAdmin()
    {
        return $this->email === 'admin@archtech.com';
    }

    // Scope for active users
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for inactive users
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

}
