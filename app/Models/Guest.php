<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guest extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'attendance_status',
    ];

    public function gifts(): HasMany
    {
        return $this->hasMany(Gift::class);
    }
}