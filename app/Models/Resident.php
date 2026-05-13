<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Resident extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'gender',
        'contact',
        'address',
    ];

    protected $casts = [
        'age' => 'integer',
    ];

    public function household(): HasOne
    {
        return $this->hasOne(Household::class, 'head_id');
    }

    public function households(): BelongsToMany
    {
        return $this->belongsToMany(Household::class, 'household_members');
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}
