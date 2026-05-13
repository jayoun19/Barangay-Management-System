<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordinance extends Model
{
    protected $fillable = [
        'ordinance_number',
        'title',
        'description',
        'enacted_date',
        'document_path',
    ];

    protected $casts = [
        'enacted_date' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function (Ordinance $ordinance) {
            if (empty($ordinance->ordinance_number)) {
                $ordinance->ordinance_number = static::generateOrdinanceNumber();
            }
        });
    }

    protected static function generateOrdinanceNumber(): string
    {
        $year = now()->format('Y');
        $nextId = (int) static::max('id') + 1;
        // Format: ORD-2026-0001
        return sprintf('ORD-%s-%04d', $year, $nextId);
    }
}