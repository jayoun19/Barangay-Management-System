<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'birthdate',
        'age',
        'gender',
        'civil_status',
        'phone',
        'address',
        'purok',
        'profile_photo_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'date',
        'password' => 'hashed',
    ];

    // Sa loob ng App\Models\User.php
public function getProfilePhotoUrlAttribute()
{
    return $this->profile_photo_path 
        ? asset('storage/' . $this->profile_photo_path) 
        : asset('images/default-avatar.png'); // Default image kung wala pang upload
}
}
