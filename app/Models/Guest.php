<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Guest extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'attendance_status',
    ];

    public function gifts(): BelongsToMany
    {
        return $this->belongsToMany(Gift::class)->withTimestamps();
    }
}