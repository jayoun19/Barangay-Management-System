<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{
    protected $fillable = [
        'case_number',
        'complainant',
        'respondent',
        'incident_details',
        'status',
        'incident_date',
    ];

    protected $casts = [
        'incident_date' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function (Blotter $blotter) {
            if (empty($blotter->case_number)) {
                $blotter->case_number = static::generateCaseNumber();
            }
        });
    }

    protected static function generateCaseNumber(): string
    {
        $nextId = (int) static::max('id') + 1;

        return sprintf('BLT-%s-%04d', now()->format('Ymd'), $nextId);
    }
}
