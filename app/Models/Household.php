<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Household extends Model
{
    protected $fillable = [
        'household_number',
        'head_id',
        'address',
    ];

    protected static function booted()
    {
        static::creating(function (Household $household) {
            if (empty($household->household_number)) {
                $household->household_number = static::generateHouseholdNumber();
            }
        });
    }

    protected static function generateHouseholdNumber(): string
    {
        $year = now()->format('Y');
        $nextId = (int) static::max('id') + 1;

        return sprintf('HH-%s-%04d', $year, $nextId);
    }

    public function head(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'head_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Resident::class, 'household_members');
    }
}
