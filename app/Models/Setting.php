<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'barangay_name',
        'logo_path',
        'address',
        'contact_email',
        'contact_phone',
    ];
}
