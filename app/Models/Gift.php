<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gift extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'guest_id',
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }
}