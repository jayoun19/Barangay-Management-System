<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    protected $fillable = [
        'resident_id',
        'type',
        'issued_at',
        'remarks',
    ];

    protected $casts = [
        'issued_at' => 'date',
    ];

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }
}
