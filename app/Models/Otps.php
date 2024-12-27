<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
        'email',
        'otp',
        'expire_at',
        'is_verified'
    ];

    protected $casts = [
        'expire_at' => 'datetime',
        'is_verified' => 'boolean'
    ];
}