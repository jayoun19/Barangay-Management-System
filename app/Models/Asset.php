<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'name',
        'category',
        'status',
        'quantity',
        'description',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];
}
