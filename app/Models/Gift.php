<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gift extends Model
{
    protected $fillable = [
        'name',
        'description',
        'url',
        'stock',
    ];

    public function guests(): BelongsToMany
    {
        return $this->belongsToMany(Guest::class)->withTimestamps();
    }

    // Método de ayuda para la vista: comprueba si el regalo ya llegó a su límite
    public function getIsSoldOutAttribute(): bool
    {
        return $this->guests()->count() >= $this->stock;
    }
}